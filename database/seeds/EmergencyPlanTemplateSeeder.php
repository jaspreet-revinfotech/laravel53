<?php


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EmergencyPlanTemplateSeeder extends Seeder
{
    private $emergencyEventList = ["Animal Hazard", "Armed Intrusion", "Bomb Threat", "Civil Disorder", "Confined Spaces", "Explosion", "Fire- Building", "Fire- Bush/Grass", "Fuel Spill", "Gas leak", "Hazardous Substances", "Internal flooding", "Medical", "Transport Incident", "Power Failure", "Radiation/Nuclear", "Seismic Disturbance", "Severe weather", "Storm surge", "Suspicious Packages", "Violent/Threatening Person", "Evacuation"];

    private $informationList = ["Purpose", "Scope", "Responsibility", "Authority", "Advisors", "Facility", "Contacts", "EPC", "ECO", "Emergency Procedures", "Evacuation Options", "PEEPs", "First Aid", "Evac Diagrams", "Training", "Reference Notes", "Review and Maintenance", "Resources", "Distribution"];

    public function run()
    {
        $this->command->info('Emergency Plan Template Seeder');
        // clear the database
        $this->command->info('Clear Database tables');
        DB::table('emergency_plan_templates')->truncate();

        $faker = Faker\Factory::create();

        $loopCount = 1;
        foreach ($this->emergencyEventList as $event)
        {
            $record = new EmergencyPlanTemplate();
            $record->slug = str_random(15);
            $record->type = "event";
            $record->tenant_id = 0;
            $record->organisation_id = 0;
            $record->facility_id = 0;
            $record->name = $event;
            $record->description = $faker->sentence;
            $record->display_sequence = $loopCount;
            $record->required = true;
            $record->template = $faker->paragraph(4);
            $record->save();
            $loopCount++;
        }

        foreach ($this->informationList as $information)
        {
            $record = new EmergencyPlanTemplate();
            $record->slug = str_random(15);
            $record->type = "information";
            $record->tenant_id = 0;
            $record->organisation_id = 0;
            $record->facility_id = 0;
            $record->name = $information;
            $record->description = $faker->sentence;
            $record->display_sequence = $loopCount;
            $record->required = true;
            $record->template = $faker->paragraph(4);
            $record->save();
            $loopCount++;
        }
    }
}