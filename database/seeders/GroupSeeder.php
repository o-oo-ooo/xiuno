<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            ['name' => '游客组',        'credits_from' => 0,     'credits_to' => 0,          'allowread' => 1, 'allowthread' => 0, 'allowpost' => 1, 'allowattach' => 0, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '管理员组',      'credits_from' => 0,     'credits_to' => 0,          'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 1, 'allowupdate' => 1, 'allowdelete' => 1, 'allowmove' => 1, 'allowbanuser' => 1, 'allowdeleteuser' => 1, 'allowviewip' => 1],
            ['name' => '超级版主组',    'credits_from' => 0,     'credits_to' => 0,          'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 1, 'allowupdate' => 1, 'allowdelete' => 1, 'allowmove' => 1, 'allowbanuser' => 1, 'allowdeleteuser' => 1, 'allowviewip' => 1],
            ['name' => '版主组',        'credits_from' => 0,     'credits_to' => 0,          'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 1, 'allowupdate' => 1, 'allowdelete' => 1, 'allowmove' => 1, 'allowbanuser' => 1, 'allowdeleteuser' => 0, 'allowviewip' => 1],
            ['name' => '实习版主组',    'credits_from' => 0,     'credits_to' => 0,          'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 1, 'allowupdate' => 1, 'allowdelete' => 0, 'allowmove' => 1, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '待验证用户组',  'credits_from' => 0,     'credits_to' => 0,          'allowread' => 1, 'allowthread' => 0, 'allowpost' => 1, 'allowattach' => 0, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '禁止用户组',    'credits_from' => 0,     'credits_to' => 0,          'allowread' => 0, 'allowthread' => 0, 'allowpost' => 0, 'allowattach' => 0, 'allowdown' => 0, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '一级用户组',    'credits_from' => 0,     'credits_to' => 50,         'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '二级用户组',    'credits_from' => 50,    'credits_to' => 200,        'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '三级用户组',    'credits_from' => 200,   'credits_to' => 1000,       'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '四级用户组',    'credits_from' => 1000,  'credits_to' => 10000,      'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
            ['name' => '五级用户组',    'credits_from' => 10000, 'credits_to' => 10000000,   'allowread' => 1, 'allowthread' => 1, 'allowpost' => 1, 'allowattach' => 1, 'allowdown' => 1, 'allowtop' => 0, 'allowupdate' => 0, 'allowdelete' => 0, 'allowmove' => 0, 'allowbanuser' => 0, 'allowdeleteuser' => 0, 'allowviewip' => 0],
        ]);
    }
}
