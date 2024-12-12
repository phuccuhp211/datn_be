<?php

namespace App\Http\Controllers\Client;

use App\Repositories\SponsorRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use App\Mail\ThankYouMail;
use Illuminate\Support\Facades\Mail;

class SponsorController extends Controller
{
    protected $sponsorRepo;

    public function __construct(SponsorRepositoryInterface $sponsorRepo)
    {
        $this->sponsorRepo = $sponsorRepo;
    }

    public function index()
    {
        return response()->json($this->sponsorRepo->getAll());
    }

    public function show($id)
    {
        $sponsor = $this->sponsorRepo->getById($id);
        return $sponsor ? response()->json($sponsor) : response()->json(['message' => 'Sponsor not found'], 404);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:1',
            'project_id' => 'required|exists:projects,id',
            'date' => 'required|date',
        ]);

        $sponsor = Sponsor::create($validatedData);

        // Lấy thông tin dự án để gửi trong email
        $project = $sponsor->project;
        $sponsorData = [
            'name' => $sponsor->name,
            'email' => $sponsor->email,
            'amount' => $sponsor->amount,
            'project_name' => $project->name,
        ];

        // Gửi email cảm ơn
        Mail::to($sponsor->email)->send(new ThankYouMail($sponsorData));

        return response()->json(['success' => true, 'sponsor' => $sponsor], 201);
    }
}
