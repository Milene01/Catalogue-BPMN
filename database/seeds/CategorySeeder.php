<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Extension Proposal', 'description' => 'Is the extension proposed for a specific domain, Application Areas or improvement of the language itself?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 2, 'name' => 'Meaning - Concepts Introduced', 'description' => 'Do the extensions present the meaning of the new concepts introduced?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 3, 'name' => 'Application Area/Specific Domain', 'description' => 'What are the Specific Domains/Application Areas targeted by the BPMN extensions?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 4, 'name' => 'Syntax Level', 'description' => 'The extension is presented at which syntax level?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 5, 'name' => 'Syntax Compatibility', 'description' => 'Are concrete and abstract syntaxes compatible?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 6, 'name' => 'Conservative', 'description' => 'Are the proposed extensions conservative or non-conservative?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 7, 'name' => 'New Graphical Representations/Adaptation', 'description' => 'Which BPMN extensions have introduced new graphical representations for constructors compared to those that have adapted existing constructor representations?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 8, 'name' => 'Construct Modified', 'description' => 'Which BPMN language constructors have been modified in the extensions identified?', 'type' => 'text', 'total_allowed' => 0, 'image_category' => 0],
            ['id' => 9, 'name' => 'Tool Support', 'description' => 'Which tool support was proposed for BPMN extensions?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
            ['id' => 10, 'name' => 'OMG', 'description' => 'Do the proposed extensions comply with the extension mechanism specified by the OMG?', 'type' => 'text', 'total_allowed' => 1, 'image_category' => 0],
        ]);
    }
}
