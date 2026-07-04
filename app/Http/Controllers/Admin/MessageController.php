<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        $messages = Contact::orderByDesc('created_at')->paginate(20);
        return view('admin.messages.index', compact('messages'));
    }
    public function show(Contact $message) {
        if (!$message->is_read) $message->update(['is_read' => true]);
        return view('admin.messages.show', compact('message'));
    }
    public function destroy(Contact $message) {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprime.');
    }
}
