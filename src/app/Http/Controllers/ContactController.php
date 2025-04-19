<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    // 管理画面の表示（検索機能含む）
    public function index(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }

        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->paginate(7);
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    // お問い合わせフォームの表示
    public function contactForm()
    {
        $categories = Category::all();
        return view('contact.form', compact('categories'));
    }

    // お問い合わせの確認画面
    public function confirm(ContactRequest $request)
    {
        $validatedData = $request->validated();
        return view('contact.confirm', compact('validatedData'));
    }

    // お問い合わせデータの送信
    public function submit(ContactRequest $request)
    {
        Contact::create($request->validated());
        return redirect()->route('contact.form')->with('success', 'お問い合わせを送信しました');
    }

    // 詳細表示（モーダルウィンドウ用）
    public function show($id)
    {
        $contact = Contact::with('category')->findOrFail($id);
        return response()->json($contact);
    }

    // 削除機能
    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin')->with('success', 'お問い合わせを削除しました');
    }

    // CSVエクスポート機能（検索結果をそのまま反映）
    public function export(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('name', 'LIKE', "%{$request->name}%");
        }

        if ($request->filled('email')) {
            $query->where('email', 'LIKE', "%{$request->email}%");
        }

        if ($request->filled('gender') && $request->gender !== '') {
            $query->where('gender', $request->gender);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->get();
        $csvData = [];

        foreach ($contacts as $contact) {
            $csvData[] = [
                '名前' => $contact->name,
                '性別' => $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                'メールアドレス' => $contact->email,
                'お問い合わせ種類' => $contact->category->content,
                '日付' => $contact->created_at->format('Y-m-d'),
            ];
        }

        $headers = ['Content-Type' => 'text/csv'];
        $callback = function () use ($csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, array_keys($csvData[0]));
            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}