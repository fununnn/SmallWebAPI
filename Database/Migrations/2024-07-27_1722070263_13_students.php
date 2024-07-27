<?php
namespace Database\Migrations;
use Database\SchemaMigration;

class Students implements SchemaMigration
{
    public function up(): array
    {
        return [
            "id INT PRIMARY KEY AUTO_INCREMENT,
                name VARCHAR(100),
                age INT,
                major VARCHAR(50)"
        ];
    }

    public function down(): array
    {
        // Implement the down migration if necessary
        return [
            // Add down migration SQL here
        ];
    }
}