<?php

namespace Modules\HR\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Modules\HR\Entities\HrJobDomain;

class DomainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('hr.opportunities.domains') as $slug => $domain) {
            HrJobDomain::updateOrCreate(
                [
                    'slug' => $slug,
                ],
                [
                    'domain_name' => $domain,
                    'slug' => $slug,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
