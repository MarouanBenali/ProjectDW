<?php
namespace App\Http\Controllers;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller{
public function destroy($conversationId)
{
    $conversation = Conversation::findOrFail($conversationId);
    if (Auth::user()->role  === 'manager') {
        $conversation->delete();
        return redirect()->back();
    }

    return redirect()->back();
}
}
?>