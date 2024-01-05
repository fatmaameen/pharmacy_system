<?php

use App\Http\Controllers\NigthCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobTitleController;
use App\Http\Controllers\AdmimCompanyController;
use App\Http\Controllers\Categories_StoreController;
use App\Http\Controllers\DailyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\LatesubcatgController;
use App\Http\Controllers\LatesubsubController;
use App\Http\Controllers\NigthsubController;
use App\Http\Controllers\Raw_MaterialController;
use App\Http\Controllers\SubCategries_StoreController;
use App\Http\Controllers\SubSubCategoriesController;
use App\Http\Controllers\Suppliers_StoreController;
use App\Http\Controllers\Nigthsubsubcatg;
use App\Models\NigthSunsubCatg;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('dashboard',[DashboardController::class,'index'])->name('dashboard');

/////////job title
Route::prefix('types/of/jobs')->group(function () {

    Route::get('/create', [JobTitleController::class, 'create'])->name('companies.type.of.job.create');
    Route::post('/store', [JobTitleController::class, 'store'])->name('companies.type.of.job.store');
    Route::get('/datatable', [JobTitleController::class, 'datatable'])->name('companies.type.of.job.datatable');
    Route::put('/update/{id}', [JobTitleController::class, 'update'])->name('companies.type.of.job.update');
});

Route::prefix('admin/company')->group(function () {
    Route::get('/index', [AdmimCompanyController::class, 'index'])->name('super.admin.create.admin.company.index');
    Route::get('/create', [AdmimCompanyController::class, 'create'])->name('super.admin.create.admin.company.create');
    Route::post('/store', [AdmimCompanyController::class, 'store'])->name('super.admin.create.admin.company.store');
    Route::get('/index/datatable', [AdmimCompanyController::class, 'datatable'])->name('super.admin.create.admin.company.datatable');
    Route::put('/status/change', [AdmimCompanyController::class, 'status'])->name('super.admin.create.admin.company.status');
    Route::get('/edit/{id}', [AdmimCompanyController::class, 'edit'])->name('super.admin.create.admin.company.edit');
    Route::put('/update/{id}', [AdmimCompanyController::class, 'update'])->name('super.admin.create.admin.company.update');
});




////////////////////////////////////////////////



Route::prefix('suppliers/store')->group(function(){
    Route::get('/create/suppliers',[Suppliers_StoreController::class,'create'])->name('admin.companies.suppliers.create');
    Route::get('/create/phone/supplier/{id}',[Suppliers_StoreController::class,'create_phone'])->name('admin.companies.suppliers.create_phone');
    Route::get('/create/address/supplier/{id}',[Suppliers_StoreController::class,'create_address'])->name('admin.companies.suppliers.create_address');
    Route::post('/store/suppliers',[Suppliers_StoreController::class,'store'])->name('admin.companies.suppliers.store');
    Route::post('/store/phone/suppliers/{id}',[Suppliers_StoreController::class,'store_phone'])->name('admin.companies.suppliers.store_phone');
    Route::post('/store/address/suppliers/{id}',[Suppliers_StoreController::class,'store_address'])->name('admin.companies.suppliers.store_address');
    Route::get('/index',[Suppliers_StoreController::class,'index'])->name('admin.companies.suppliers.store.index');
    Route::get('/datatable',[Suppliers_StoreController::class,'datatable'])->name('admin.companies.suppliers.store.datatable');
    Route::get('/edit/{id}',[Suppliers_StoreController::class,'edit'])->name('admin.companies.suppliers.store.edit');
    Route::put('/update/{id}',[Suppliers_StoreController::class,'update'])->name('admin.companies.suppliers.store.update');
    Route::get('/view/image/{id}',[Suppliers_StoreController::class,'view_image'])->name('admin.companies.suppliers.view.image');
    Route::get('/view/file/{id}',[Suppliers_StoreController::class,'view_file'])->name('admin.companies.suppliers.view.file');
    Route::get('/view/address/{id}',[Suppliers_StoreController::class,'view_address'])->name('admin.companies.suppliers.view.address');

});



           /////categories store routes


 Route::get('categories/create',[Categories_StoreController::class,'create'])->name('categories.create');
 Route::post('categories/store',[Categories_StoreController::class,'store'])->name('categories.store');
Route::get('categories/index',[Categories_StoreController::class,'index'])->name('categories.index');
Route::get('categories/datatable',[Categories_StoreController::class,'datatable'])->name('categories.datatable');
Route::put('categories/status/change',[Categories_StoreController::class,'status'])->name('categories.status');
Route::get('categories/edit/{id}',[Categories_StoreController::class,'edit'])->name('categories.edit');
Route::put('categories/update/{id}',[Categories_StoreController::class,'update'])->name('categories.update');
Route::any('showsub/{id}',[Categories_StoreController::class,'show_sub'])->name('show_sub');


                    //////subcategory

     Route::any('subcategories/create',[SubCategries_StoreController::class,'create'])->name('subcategories.create');
    Route::post('subcategories/store',[SubCategries_StoreController::class,'store'])->name('subcategories.store');
  Route::any('subcategories/index',[SubCategries_StoreController::class,'index'])->name('subcategories.index');
 Route::get('subcategories/datatable/{id}',[SubCategries_StoreController::class,'datatable'])->name('subcategories.datatable');
 Route::put('subcategories/status/change',[SubCategries_StoreController::class,'status'])->name('subcategories.status');
 Route::get('subcatg/edit/{id}',[SubCategries_StoreController::class,'edit'])->name('subcatg.edit');
Route::put('subcategories/update/{id}',[SubCategries_StoreController::class,'update'])->name('subcatg.update');
Route::any('showsubsub/{id}',[SubCategries_StoreController::class,'show_subsub'])->name('show_subsub');

  //////subsubcategory

    Route::any('subsubcategories/create',[SubSubCategoriesController::class,'create'])->name('subsubcategories.create');
    Route::post('subsubcategories/store',[SubSubCategoriesController::class,'store'])->name('subsubcategories.store');
    Route::any('subsubcategories/index',[SubSubCategoriesController::class,'index'])->name('subsubcategories.index');
    // Route::get('/datatable/{id}',[SubSubCategoriesController::class,'datatable'])->name('admin.companies.subcategories.store.datatable');
    // Route::put('/status/change',[SubSubCategoriesController::class,'status'])->name('admin.companies.subcategories.store.status');
    Route::get('subsubcatg/edit/{id}',[SubSubCategoriesController::class,'edit'])->name('subsubcatg.edit');
    Route::put('subsubcatg/update/{id}',[SubSubCategoriesController::class,'update'])->name('subsubcatg.update');





          /////raw materies

          /////raw materies
          Route::prefix('/raw/materies')->group(function(){
            Route::get('/create',[Raw_MaterialController::class,'create'])->name('raw.matiries.create');

            Route::post('/store',[Raw_MaterialController::class,'store'])->name('raw.matiries.store');

            Route::get('/datatable/{id}',[Raw_MaterialController::class,'datatable'])->name('raw.matiries.datatable');
            /////////////sub

            Route::get('/subcategories/material/datatable/{id}',[Raw_MaterialController::class,'datatable_subcat'])->name('raw.matiries.subcategories.material.datatable');

            //////update selling price
             ////////update raw material
            Route::get('/edit/{id}',[Raw_MaterialController::class,'edit'])->name('raw.matiries.edit');

            Route::put('/update/{id}',[Raw_MaterialController::class,'update'])->name('raw.matirie.update');
            Route::put('/status/change/',[Raw_MaterialController::class,'status'])->name('raw.matiries.status');

        });
        Route::get('/products/shifts',[Raw_MaterialController::class,'shifts'])->name('products.shifts');
////////////////////////////////////////////////////////products morning shift /////////////////////////////////////////////////////////////////////////////////
Route::get('/categories/material/list',[Raw_MaterialController::class,'index_category'])->name('raw.matiries.categories.material.index');
Route::get('/subcategories/material/list/{id}',[Raw_MaterialController::class,'index_subcat'])->name('raw.matiries.subcategories.material.index');
Route::get('/subsubcategories/material/list/{id}',[Raw_MaterialController::class,'index_subsubcat'])->name('raw.matiries.subsubcategories.material.index');
Route::get('/index/{id}',[Raw_MaterialController::class,'index'])->name('raw.matiries.index');
Route::get('shows/products/{id}' ,[Raw_MaterialController::class , 'show_product'])->name('show_product');
Route::get('show/subproduct/{id}' ,[Raw_MaterialController::class , 'show_subproducts'])->name('show_subproducts');
Route::get('add/quantity/{id}' ,[Raw_MaterialController::class , 'addQuantity'])->name('product.addQuantity');
Route::post('/store/{product?}',[Raw_MaterialController::class,'store_quantity'])->name('store_quantity');

Route::get('show/addquantity/{id}' ,[Raw_MaterialController::class , 'show_addquantity'])->name('show_addquantity');
Route::get('quantity/delete/{id}' ,[Raw_MaterialController::class , 'quantity_delete'])->name('quantity_delete');
Route::put('quantity/edit/{id}' ,[Raw_MaterialController::class , 'quantity_edit'])->name('quantity_edit');

  ///////////////////////////////////////////////////// products nigth shift///////////////////////////////////////////////////


  Route::get('nigth/categories/list',[Raw_MaterialController::class,'nigth_index_category'])->name('products.nigth.index');
  Route::get('nigth/subcategories/material/list/{id}',[Raw_MaterialController::class,'nigth_index_subcat'])->name('nigth.subcategories.index');
  Route::get('nigth/subsubcategories/material/list/{id}',[Raw_MaterialController::class,'nigth_index_subsubcat'])->name('nigth.subsubcategories.index');
  Route::get('nigth/index/{id}',[Raw_MaterialController::class,'nigth_index'])->name('raw.nigth.index');
  Route::get('nigth/shows/products/{id}' ,[Raw_MaterialController::class , 'nigth_show_product'])->name('nigth_show_product');
  Route::get('nigth/show/subproduct/{id}' ,[Raw_MaterialController::class , 'show_subproducts'])->name('show_subproducts');
  Route::get('nigth/add/quantity/{id}' ,[Raw_MaterialController::class , 'nigth_addQuantity'])->name('nigth_product.addQuantity');
  Route::post('nigth/store/{product?}',[Raw_MaterialController::class,'nigth_store_quantity'])->name('nigth_store_quantity');

  Route::get('nigth/show/addquantity/{id}' ,[Raw_MaterialController::class , 'nigth_show_addquantity'])->name('nigth_show_addquantity');
  Route::get('nigth/quantity/delete/{id}' ,[Raw_MaterialController::class , 'nigth_quantity_delete'])->name('nigth_quantity_delete');
  Route::put('nigth/quantity/edit/{id}' ,[Raw_MaterialController::class , 'nigth_quantity_edit'])->name('nigth_quantity_edit');
  Route::get('nigth/edit/{id}',[Raw_MaterialController::class,'nigth_edit'])->name('raw.nigth.edit');
  Route::put('nigth/update/{id}',[Raw_MaterialController::class,'nigth_update'])->name('raw.nigth.update');











        Route::get('/subcategories/{id}' ,[Categories_StoreController::class ,'get_subcategory'])->name('subcategories');
        Route::get('/subsubcategories/{id}' ,[Categories_StoreController::class ,'get_subsubcategory'])->name('subsubcategories');

        Route::prefix('صرف/المنتجات')->group(function(){
            Route::get('/انشاء/اذن',[ExpensesController::class,'create_invoce'])->name('expenses.create_invoce');
            Route::post('/حفظ',[ExpensesController::class,'store_invoce'])->name('expenses.store_invoce');
            Route::get('عرض/المنتجات/{id}',[ExpensesController::class,'index'])->name('expenses.product');
            Route::get('/datatable/{id}',[ExpensesController::class,'datatable'])->name('expenses.datatable');
            Route::get('/فئات',[ExpensesController::class,'index_category'])->name('expenses.categories');

            Route::get('/datatable/subcategories/{id}',[ExpensesController::class,'datatable_subcat'])->name('expenses.subcategories.datatable');
            Route::put('/add/to/invoice/{id}',[ExpensesController::class,'add_to_card'])->name('expenses.add.to.card');

            Route::get('/عرض/العربيه',[ExpensesController::class,'card_view'])->name('expenses.card_view');

            Route::get('/مسح/منتج/العربيه/{id}',[ExpensesController::class,'card_delete'])->name('expenses.card_delete');

            Route::put('/تعديل/منتج/العربيه/{id}',[ExpensesController::class,'card_edit'])->name('expenses.card_edit');
            Route::get('حفظ/المصروفات',[ExpensesController::class,'card_save'])->name('expenses.save');

        });
        /////////////////////////////////////stop////////////////////////////////
        Route::get('/expenses/subcategories/{id}',[ExpensesController::class,'index_subcat'])->name('expenses.subcategories');
        Route::get('expenses/subsub/{id}',[ExpensesController::class,'expenses_subsub'])->name('expenses.subsub');
        Route::get('expenses/subsubproducts/{id}',[ExpensesController::class,'subsubproducts'])->name('expenses.subsubproducts');
        Route::any('expenses/pull/{id}',[ExpensesController::class,'expenses_pull'])->name('expenses.pull');
        Route::any('expenses/catgpull/{id}',[ExpensesController::class,'expenses_catgpull'])->name('expenses.catgpull');
        Route::any('expenses/show/product/{id}',[ExpensesController::class,'show_product'])->name('expenses.show_product');
        Route::any('expenses/show/subproduct/{id}',[ExpensesController::class,'show_subproduct'])->name('expenses.show_subproduct');
        Route::any('expenses/subcatgpull/{id}',[ExpensesController::class,'expenses_subcatgpull'])->name('expenses.subcatgpull');
        Route::any('show/addQuantity/{id}',[ExpensesController::class,'show_addQuantity'])->name('show_addQuantity');

        //////subcategory
      Route::prefix('سجل/المصروفات')->group(function(){
        Route::get('/قائمه',[ExpensesController::class,'histore'])->name('expenses.histore.list');
        Route::get('/datatable',[ExpensesController::class,'histore_datatable'])->name('expenses.histore.datatable');

        Route::get('/قائمه/فرديه/{id}',[ExpensesController::class,'histore_one'])->name('expenses.histore_one.list');
        Route::get('/datatable/فرديه/{id}',[ExpensesController::class,'histore_datatable_one'])->name('expenses.histore_one.datatable');

    });
    Route::get('/product/search', [Raw_MaterialController::class, '__invoke'])->name('product.search');

////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::prefix('/daliy')->group(function(){

    Route::get('/categories/Daily/list', [DailyController::class ,'index_category'])->name('daily.categories.material.index');
    Route::get('/subcategories/{id}',[DailyController::class,'index_subcat'])->name('daily.subcategories.material.index');
    Route::get('show/daily/product/{id}' ,[DailyController::class , 'show_product'])->name('daily_show_product');

    Route::get('/daily/subsubcategories/{id}',[DailyController::class,'index_subsubcat'])->name('daily.subsubcategories.index');
    Route::get('/daily/index/{id}',[DailyController::class,'index'])->name('daily.index');
    Route::put('/add/to/daily/{id}',[DailyController::class,'add_daily_used'])->name('add_daily_used');
    Route::get('/show/daily/',[DailyController::class,'daily_view'])->name('daily_used_view');

    Route::get('/daily_used/{id}',[DailyController::class,'daily_used_delete'])->name('daily_used_delete');

    Route::put('/daily/edit{id}',[DailyController::class,'daily_used_edit'])->name('daily_used_edit');
    Route::get('daily/show/subproduct/{id}' ,[DailyController::class , 'show_subproducts'])->name('daily_show_subproducts');
/////////////////////////////////////////// daily_nigth//////////////////////////////////////
Route::get('daily/nigth/list', [DailyController::class ,'nigth_daily_index_category'])->name('daily_nigth.categories.index');







//////////////////////////////////////    daily_late  ///////////////////////////////////
Route::get('daily/late/list', [DailyController::class ,'late_daily_index_category'])->name('daily_late.categories.index');










});
Route::get('shifts' , [Categories_StoreController::class ,'shifts'])->name('shifts');
Route::get('pages' , [Categories_StoreController::class ,'pages'])->name('pages');
Route::get('nigth' , [Categories_StoreController::class ,'nigth'])->name('nigth');
Route::get('late' , [Categories_StoreController::class ,'late'])->name('late');

Route::get('daily/shifts' , [DailyController::class ,'shifts'])->name('daily_shifts');

           /////Nigth categories


           Route::get('nigth/categories/create',[NigthCategory::class,'create'])->name('nigth_categories.create');
           Route::post('nigth/categories/store',[NigthCategory::class,'store'])->name('nigth_categories.store');
          Route::get('nigth/categories/index',[NigthCategory::class,'index'])->name('nigth_categories.index');

          Route::get('nigth/categories/edit/{id}',[NigthCategory::class,'edit'])->name('nigth_categories.edit');
          Route::put('nigth/categories/update/{id}',[NigthCategory::class,'update'])->name('nigth_categories.update');
          Route::any('nigth/showsub/{id}',[NigthCategory::class,'show_sub'])->name('nigth_show_sub');


                              ////// Nigth subcategory

               Route::any('nigth/subcategories/create',[NigthsubController::class,'create'])->name('nigth_subcategories.create');
              Route::post('nigth/subcategories/store',[NigthsubController::class,'store'])->name('nigth_subcategories.store');
            Route::any('nigth/subcategories/index',[NigthsubController::class,'index'])->name('nigth_subcategories.index');

           Route::get('nigth/subcatg/edit/{id}',[NigthsubController::class,'edit'])->name('nigth_subcatg.edit');
          Route::put('nigth/subcategories/update/{id}',[NigthsubController::class,'update'])->name('nigth_subcatg.update');
          Route::any('nigth/showsubsub/{id}',[NigthsubController::class,'show_subsub'])->name('nigth_show_subsub');

            ////// Nigth subsubcategory

              Route::any('nigth/subsubcategories/create',[NigthSubsubCatg::class,'create'])->name('nigth_subsubcategories.create');
              Route::post('nigth/subsubcategories/store',[NigthSubsubCatg::class,'store'])->name('nigth_subsubcategories.store');
              Route::any('nigth/subsubcategories/index',[NigthSubsubCatg::class,'index'])->name('nigth_subsubcategories.index');
              // Route::get('/datatable/{id}',[SubSubCategoriesController::class,'datatable'])->name('admin.companies.subcategories.store.datatable');
              // Route::put('/status/change',[SubSubCategoriesController::class,'status'])->name('admin.companies.subcategories.store.status');
              Route::get('nigth/subsubcatg/edit/{id}',[NigthSubsubCatg::class,'edit'])->name('nigth_subsubcatg.edit');
              Route::put('nigth/subsubcatg/update/{id}',[NigthSubsubCatg::class,'update'])->name('nigth_subsubcatg.update');


        //    /////late categories


           Route::get('late/categories/create',[LateController::class,'create'])->name('late_categories.create');
           Route::post('late/categories/store',[LateController::class,'store'])->name('late_categories.store');
          Route::get('late/categories/index',[LateController::class,'index'])->name('late_categories.index');

          Route::get('late/categories/edit/{id}',[LateController::class,'edit'])->name('late_categories.edit');
          Route::put('late/categories/update/{id}',[LateController::class,'update'])->name('late_categories.update');
          Route::any('late/showsub/{id}',[LateController::class,'show_sub'])->name('late_show_sub');


        //                       ////// late subcategory

               Route::any('late/subcategories/create',[LatesubcatgController::class,'create'])->name('late_subcategories.create');
              Route::post('late/subcategories/store',[LatesubcatgController::class,'store'])->name('late_subcategories.store');
            Route::any('late/subcategories/index',[LatesubcatgController::class,'index'])->name('late_subcategories.index');

           Route::get('late/subcatg/edit/{id}',[LatesubcatgController::class,'edit'])->name('late_subcatg.edit');
          Route::put('late/subcategories/update/{id}',[LatesubcatgController::class,'update'])->name('late_subcatg.update');
          Route::any('late/showsubsub/{id}',[LatesubcatgController::class,'show_subsub'])->name('late_show_subsub');

        //     ////// late subsubcategory

              Route::any('late/subsubcategories/create',[LatesubsubController::class,'create'])->name('late_subsubcategories.create');
              Route::post('late/subsubcategories/store',[LatesubsubController::class,'store'])->name('late_subsubcategories.store');
              Route::any('late/subsubcategories/index',[LatesubsubController::class,'index'])->name('late_subsubcategories.index');
              // Route::get('/datatable/{id}',[SubSubCategoriesController::class,'datatable'])->name('admin.companies.subcategories.store.datatable');
              // Route::put('/status/change',[SubSubCategoriesController::class,'status'])->name('admin.companies.subcategories.store.status');
              Route::get('late/subsubcatg/edit/{id}',[LatesubsubController::class,'edit'])->name('late_subsubcatg.edit');
              Route::put('late/subsubcatg/update/{id}',[LatesubsubController::class,'update'])->name('late_subsubcatg.update');

