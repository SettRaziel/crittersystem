<?php

declare(strict_types=1);

namespace Engelsystem\Migrations;

use Engelsystem\Database\Migration\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder as SchemaBuilder;
use Ramsey\Uuid\Uuid;

class FixAdminGroupId extends Migration
{
    protected Connection $db;

    public function __construct(SchemaBuilder $schema)
    {
        parent::__construct($schema);
        $this->db = $this->schema->getConnection();
    }

    public function up(): void
    {
        $this->db->table('groups')
            ->where(['name' => 'Admin'])
            ->update(['id' => 200]);

        $this->db->table('group_privileges')
            ->where(['group_id' => 1])
            ->update(['group_id' => 200]);

        $this->db->table('users_groups')
            ->where(['group_id' => 1])
            ->update(['group_id' => 200]);
    }

    public function down(): void
    {
        $this->db->table('groups')
            ->where(['name' => 'Admin'])
            ->update(['id' => 1]);

        $this->db->table('group_privileges')
            ->where(['group_id' => 200])
            ->update(['group_id' => 1]);

        $this->db->table('users_groups')
            ->where(['group_id' => 200])
            ->update(['group_id' => 1]);
    }
}
