<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::with('category');

        // 検索条件
        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%'.$request->name.'%')
                  ->orWhere('last_name', 'like', '%'.$request->name.'%');
            });
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%'.$request->email.'%');
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->paginate(7)->appends($request->all());
        $categories = Category::all();

        return view('admin.admin', compact('contacts', 'categories'));
    }

    public function show(Contact $contact)
    {
        $contact->load('category');
        return response()->json($contact);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(['success' => true]);
    }

    public function export(Request $request)
    {
        $query = Contact::with('category');

        // 検索条件（indexと同じ）
        if ($request->filled('name')) {
            $query->where(function($q) use ($request) {
                $q->where('first_name', 'like', '%'.$request->name.'%')
                  ->orWhere('last_name', 'like', '%'.$request->name.'%');
            });
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%'.$request->email.'%');
        }
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        $contacts = $query->orderBy('created_at', 'desc')->get();

        $csvHeader = [
            'お問い合わせ日時', 'お問い合わせの種類', '氏名', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ内容'
        ];

        $csvData = [];
        foreach ($contacts as $contact) {
            $csvData[] = [
                $contact->created_at->format('Y/m/d H:i'),
                $contact->category->content,
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender == 1 ? '男性' : ($contact->gender == 2 ? '女性' : 'その他'),
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->detail,
            ];
        }

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $handle = fopen('php://temp', 'r+');
        fputcsv($handle, $csvHeader);
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}