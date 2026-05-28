<?php
// Use this code to log changes in db from code, not from db triggers
//namespace App\Observers;
//
//use App\Models\Book;
//use App\Models\Loan;
//use App\Models\Log;
//use App\Models\User;
//use Illuminate\Support\Facades\DB;
//use Illuminate\Support\Facades\Log as Logger;
//
//class GlobalDatabaseObserver
//{
//    public function created(Book|Loan|User $model)
//    {
//        try {
//            DB::transaction(function () use ($model) {
//                Log::create([
//                    'table_name' => $model->getTable(),
//                    'operation' => 'INSERT',
//                    'book_id' => $model instanceof Book ? $model->getKey() : null,
//                    'loan_id' => $model instanceof Loan ? $model->getKey() : null,
//                    'user_id' => $model instanceof User ? $model->getKey() : null,
//                    'old_value' => null,
//                    'new_value' => json_encode($model->toArray()),
//                ]);
//            });
//            Logger::info('Log created successfully (CREATE)');
//        } catch (\Exception $e) {
//            Logger::error('Error creating log (CREATE): ' . $e->getMessage());
//        }
//    }
//
//    public function updated(Book|Loan|User $model)
//    {
//        try {
//            DB::transaction(function () use ($model) {
//                $changes = [];
//                foreach ($model->getChanges() as $key => $newValue) {
//                    $oldValue = $model->getOriginal($key);
//                    $changes[$key] = ['old' => $oldValue, 'new' => $newValue];
//                }
//
//                Log::create([
//                    'table_name' => $model->getTable(),
//                    'operation' => 'UPDATE',
//                    'book_id' => $model instanceof Book ? $model->getKey() : null,
//                    'loan_id' => $model instanceof Loan ? $model->getKey() : null,
//                    'user_id' => $model instanceof User ? $model->getKey() : null,
//                    'old_value' => json_encode($model->getOriginal()),
//                    'new_value' => json_encode($changes),
//                ]);
//            });
//            Logger::info('Log created successfully (UPDATE)');
//        } catch (\Exception $e) {
//            Logger::error('Error creating log (UPDATE): ' . $e->getMessage());
//        }
//    }
//
//    public function deleted(Book|Loan|User $model)
//    {
//        try {
//            DB::transaction(function () use ($model) {
//                Log::create([
//                    'table_name' => $model->getTable(),
//                    'operation' => 'DELETE',
//                    'book_id' => $model instanceof Book ? $model->getKey() : null,
//                    'loan_id' => $model instanceof Loan ? $model->getKey() : null,
//                    'user_id' => $model instanceof User ? $model->getKey() : null,
//                    'old_value' => json_encode($model->toArray()),
//                    'new_value' => null,
//                ]);
//            });
//            Logger::info('Log created successfully (DELETE)');
//        } catch (\Exception $e) {
//            Logger::error('Error creating log (DELETE): ' . $e->getMessage());
//        }
//    }
//}
