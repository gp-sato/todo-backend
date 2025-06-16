<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * 認証中のユーザーのタスク一覧を返す
     */
    public function index(Request $request)
    {
        return $request->user()->tasks()->latest()->get();
    }

    /**
     * 新しいタスクを作成する
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = $request->user()->tasks()->create([
            'title' => $validated['title'],
        ]);

        return response()->json($task, 201);
    }

    /**
     * タスクの完了状態を更新する
     */
    public function update(Request $request, Task $task)
    {
        Gate::authorize('update', $task);  // ポリシーでユーザー確認

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'is_completed' => 'sometimes|boolean',
            'due_date' => 'sometimes|nullable|date',
        ]);

        // 空文字対策
        if (array_key_exists('due_date', $validated) && $validated['due_date'] === '') {
            $validated['due_date'] = null;
        }

        // 一括で更新
        $task->fill($validated);
        $task->save();

        return response()->json($task);
    }

    /**
     * タスクを削除する
     */
    public function destroy(Request $request, Task $task)
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return response()->json(['message' => 'task deleted']);
    }
}
