<?php
namespace App\Http\Controllers;

use App\Models\Instructions;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    public function index()
    {
        $instructions = Instructions::all();
        return view('dashboard.instructions', compact('instructions'));
    }

    public function create()
    {
        return view('instructions');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        Instructions::create($request->all());
        return redirect()->route('instructions.index')->with('success', 'Instruction created successfully.');
    }

    public function update(Request $request, Instructions $instruction)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        $instruction->update($request->all());
        return redirect()->route('instructions.index')->with('success', 'Instruction updated successfully.');
    }

    public function destroy(Instructions $instruction)
    {
        $instruction->delete();
        return redirect()->route('instructions.index')->with('success', 'Instruction deleted successfully.');
    }
}
