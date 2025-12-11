<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        //! delete media sets when a post is deleted
        DB::unprepared("
            CREATE TRIGGER delete_media_sets_after_post_delete
            AFTER DELETE ON posts
            FOR EACH ROW
            BEGIN
                DELETE FROM media_sets WHERE id = OLD.media_set_id;
            END
        ");

    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS delete_media_sets_after_post_delete");
    }
};
