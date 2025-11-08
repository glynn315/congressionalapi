<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getDashboard(Request $request)
    {
        $role = $request->input('role');
        $today = Carbon::today();

        if (!$role) {
            return response()->json(['error' => 'Role is required'], 400);
        }

        switch ($role) {
            case 'Admin':
                return $this->adminDashboard($today);

            case 'Social Worker':
                return $this->socialWorkerDashboard($today);

            case 'Encoder':
                return $this->encoderDashboard($today);

            default:
                return response()->json(['error' => 'Invalid role'], 403);
        }
    }

    private function adminDashboard($today)
    {
        $budgetTotals = DB::table('budget_fundings')
            ->select('fundings_id', DB::raw('SUM(amount) as total_budget'))
            ->groupBy('fundings_id');
        $requestTotals = DB::table('request_forms')
            ->select('provider_id', DB::raw('SUM(amount) as total_requested'))
            ->groupBy('provider_id');
        $fundings = DB::table('fundings as f')
            ->leftJoinSub($budgetTotals, 'bf', 'f.id', '=', 'bf.fundings_id')
            ->leftJoinSub($requestTotals, 'rf', 'f.id', '=', 'rf.provider_id')
            ->select(
                'f.id',
                'f.funding_information',
                DB::raw('IFNULL(bf.total_budget, 0) - IFNULL(rf.total_requested, 0) as total_remaining_budget')
            )
            ->orderBy('f.id')
            ->get();
        $totalSolicitationsToday = DB::table('solicitations')
            ->whereDate('dateSolicitate', $today)
            ->count();
        $upcomingInvitations = DB::table('invitations_information')
            ->where('dateInvitation', '>=', $today)
            ->count();
        $fundsReleased = DB::table('request_forms as r')
            ->join('fundings as f', 'r.provider_id', '=', 'f.id')
            ->whereDate('r.created_at', $today)
            ->select(
                'r.provider_id',
                'f.funding_information',
                DB::raw('SUM(r.amount) as total_released')
            )
            ->groupBy('r.provider_id', 'f.funding_information')
            ->get();
        $pettyCashCount = DB::table('budget_fundings')
            ->join('fundings', 'fundings.id', '=', 'budget_fundings.fundings_id')
            ->where('fundings.funding_information', 'Petty Cash')
            ->whereDate('budget_fundings.date_created', $today)
            ->count();
        $socialWorkerAssist = DB::table('request_forms as r')
            ->join('account_management as a', 'a.account_id', '=', 'r.account_id')
            ->where('a.role', 'Admin')
            ->whereDate('r.created_at', $today)
            ->select(
                'a.account_id',
                'a.firstname',
                'a.lastname',
                DB::raw('COUNT(r.request_form_id) as assisted_today')
            )
            ->groupBy('a.account_id', 'a.firstname', 'a.lastname')
            ->get();
        return response()->json([
            'role' => 'admin',
            'fundings' => $fundings,
            'totalSolicitationsToday' => $totalSolicitationsToday,
            'upcomingInvitations' => $upcomingInvitations,
            'fundsReleased' => $fundsReleased,
            'socialWorkerAssist' => $socialWorkerAssist,
            'pettyCash' => $pettyCashCount,
        ]);
    }

    private function socialWorkerDashboard($today)
    {
        $budgetTotals = DB::table('budget_fundings')
            ->select('fundings_id', DB::raw('SUM(amount) as total_budget'))
            ->groupBy('fundings_id');
        $requestTotals = DB::table('request_forms')
            ->select('provider_id', DB::raw('SUM(amount) as total_requested'))
            ->groupBy('provider_id');
        $totalFundings = DB::table('fundings')->count();
        $fundsReleased = DB::table('request_forms')
            ->select(DB::raw('SUM(amount) as total_released'))
            ->first();
        $fundings = DB::table('fundings as f')
            ->leftJoinSub($budgetTotals, 'bf', 'f.id', '=', 'bf.fundings_id')
            ->leftJoinSub($requestTotals, 'rf', 'f.id', '=', 'rf.provider_id')
            ->select(
                'f.id',
                'f.funding_information',
                DB::raw('IFNULL(bf.total_budget, 0) - IFNULL(rf.total_requested, 0) as total_remaining_budget')
            )
            ->orderBy('f.id')
            ->get();

        $totalAssistance = DB::table('request_forms')
            ->whereDate('created_at', $today)
            ->count();

        return response()->json([
            'role' => 'social_worker',
            'totalFundings' => $totalFundings,
            'fundings' => $fundings,
            'fundsReleased' => $fundsReleased->total_released ?? 0,
            'totalAssistance' => $totalAssistance,
        ]);
    }

    private function encoderDashboard($today)
    {
        $solicitationCount = DB::table('solicitations')
            ->whereDate('dateSolicitate', $today)
            ->count();

        $validInvitations = DB::table('invitations_information')
            ->where('dateInvitation', '>=', $today)
            ->count();

        return response()->json([
            'role' => 'encoder',
            'solicitationCountToday' => $solicitationCount,
            'validInvitations' => $validInvitations,
        ]);
    }
}
