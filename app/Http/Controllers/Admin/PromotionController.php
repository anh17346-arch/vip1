<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::with('creator')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $products = Product::all();
        
        return view('admin.promotions.create', compact('categories', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'code' => 'required|string|max:50|unique:promotions,code',
            'applies_to' => 'required|in:all_products,specific_categories,specific_products',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
            'user_type' => 'required|in:all_users,new_users,existing_users',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $promotion = Promotion::create([
                'name' => $request->name,
                'name_en' => $request->name_en,
                'description' => $request->description,
                'description_en' => $request->description_en,
                'discount_type' => $request->discount_type,
                'discount_value' => $request->discount_value,
                'min_order_amount' => $request->min_order_amount ?? 0,
                'max_discount_amount' => $request->max_discount_amount,
                'usage_limit' => $request->usage_limit,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'code' => strtoupper($request->code),
                'applies_to' => $request->applies_to,
                'category_ids' => $request->category_ids,
                'product_ids' => $request->product_ids,
                'user_type' => $request->user_type,
                'is_active' => $request->has('is_active'),
                'created_by' => auth()->id(),
            ]);

            // Sync relationships
            if ($request->applies_to === 'specific_categories' && $request->category_ids) {
                $promotion->categories()->sync($request->category_ids);
            }

            if ($request->applies_to === 'specific_products' && $request->product_ids) {
                $promotion->products()->sync($request->product_ids);
            }

            DB::commit();

            return redirect()->route('admin.promotions.index')
                ->with('success', 'Khuyến mãi đã được tạo thành công!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi tạo khuyến mãi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        $promotion->load(['creator', 'categories', 'products']);
        return view('admin.promotions.show', compact('promotion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        $categories = Category::all();
        $products = Product::all();
        $promotion->load(['categories', 'products']);
        
        return view('admin.promotions.edit', compact('promotion', 'categories', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'name_en' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_en' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed_amount',
            'discount_value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'code' => 'required|string|max:50|unique:promotions,code,' . $promotion->id,
            'applies_to' => 'required|in:all_products,specific_categories,specific_products',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
            'product_ids' => 'nullable|array',
            'product_ids.*' => 'exists:products,id',
            'user_type' => 'required|in:all_users,new_users,existing_users',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $promotion->update([
                'name' => $request->name,
                'name_en' => $request->name_en,
                'description' => $request->description,
                'description_en' => $request->description_en,
                'discount_type' => $request->discount_type,
                'discount_value' => $request->discount_value,
                'min_order_amount' => $request->min_order_amount ?? 0,
                'max_discount_amount' => $request->max_discount_amount,
                'usage_limit' => $request->usage_limit,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'code' => strtoupper($request->code),
                'applies_to' => $request->applies_to,
                'category_ids' => $request->category_ids,
                'product_ids' => $request->product_ids,
                'user_type' => $request->user_type,
                'is_active' => $request->has('is_active'),
            ]);

            // Sync relationships
            if ($request->applies_to === 'specific_categories' && $request->category_ids) {
                $promotion->categories()->sync($request->category_ids);
            } else {
                $promotion->categories()->detach();
            }

            if ($request->applies_to === 'specific_products' && $request->product_ids) {
                $promotion->products()->sync($request->product_ids);
            } else {
                $promotion->products()->detach();
            }

            DB::commit();

            return redirect()->route('admin.promotions.index')
                ->with('success', 'Khuyến mãi đã được cập nhật thành công!');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi cập nhật khuyến mãi: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        try {
            $promotion->delete();
            return redirect()->route('admin.promotions.index')
                ->with('success', 'Khuyến mãi đã được xóa thành công!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra khi xóa khuyến mãi: ' . $e->getMessage());
        }
    }

    /**
     * Toggle promotion status
     */
    public function toggleStatus(Promotion $promotion)
    {
        $promotion->update(['is_active' => !$promotion->is_active]);
        
        $status = $promotion->is_active ? 'kích hoạt' : 'vô hiệu hóa';
        return redirect()->back()
            ->with('success', "Khuyến mãi đã được {$status} thành công!");
    }

    /**
     * Generate unique promotion code
     */
    public function generateCode()
    {
        do {
            $code = strtoupper(Str::random(8));
        } while (Promotion::where('code', $code)->exists());

        return response()->json(['code' => $code]);
    }
}