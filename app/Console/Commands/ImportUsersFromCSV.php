<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ImportUsersFromCSV extends Command
{
    protected $signature = 'import:users {file}';
    protected $description = 'Import users from CSV file';

    public function handle()
    {
        $file = $this->argument('file');
        
        if (!file_exists($file) || !is_readable($file)) {
            $this->error("File tidak ditemukan atau tidak bisa dibaca!");
            return;
        }

        $csvData = array_map('str_getcsv', file($file));
        $header = array_shift($csvData);

        $this->info("Memulai proses import ".count($csvData)." user...");

        $bar = $this->output->createProgressBar(count($csvData));
        $bar->start();

        $successCount = 0;
        $failedCount = 0;

        foreach ($csvData as $row) {
            $data = array_combine($header, $row);

            $validator = Validator::make($data, [
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'NIM' => 'required|string|unique:users,NIM',
                'prodi' => 'required|string',
                'password' => 'required|string|min:8',
            ]);

            if ($validator->fails()) {
                $failedCount++;
                $bar->advance();
                continue;
            }

            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'NIM' => $data['NIM'],
                'prodi' => $data['prodi'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => now(), // Verifikasi email otomatis
            ]);

            $successCount++;
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("Import selesai!");
        $this->info("Sukses: $successCount");
        $this->info("Gagal: $failedCount");

        return 0;
    }
}