<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class CreateAdminsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {--name=admin} {--email=admin@aj3m.com} {--password=password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin to the system.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $validator = $this->validateInputs($this->options());
        if ($validator->fails()) {
            $this->error(join(PHP_EOL, array_values($validator->errors()->all())));
            return 0;
        }

        $name = $this->option("name");
        $email = $this->option("email");
        $password = $this->option("password");

        try {
            if (!User::where('email', $email)->first()) {
                try {
                    User::create(["name" => $name, "email" => $email, "password" => $password])->assignRole("admin");
                    $this->info("User have been Created Successfully");
                    $this->info("Name: $name\nEmail: $email\nPassword: $password");
                } catch (\Exception $exception) {
                    $this->error($exception->getMessage());
                }

            } else {
                $this->warn("User with following email: \"$email\" already exists.");
                $this->info("User couldn't be created.");
            }
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
            $this->info("Please make sure you migrated database before you start using this command.");
        }

        return 0;
    }


    private function validateInputs($inputs)
    {
        return Validator::make($inputs, [
            "name" => ["required"],
            "email" => ["required", "email"],
            "password" => ["required", "min:6"]
        ]);
    }
}
