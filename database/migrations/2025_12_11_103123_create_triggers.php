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


        //! delete followership when a user blocks another user
        //TODO handle using kafka
        // DB::unprepared("
        //     CREATE TRIGGER delete_followership_after_user_block
        //     AFTER INSERT ON user_blocks
        //     FOR EACH ROW
        //     BEGIN
        //         DELETE FROM follows 
        //         WHERE (follower_id = NEW.blocker_id AND followed_id = NEW.blocked_id)
        //            OR (follower_id = NEW.blocked_id AND followed_id = NEW.blocker_id);
        //     END
        // ");

    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS delete_media_sets_after_post_delete");
        DB::unprepared("DROP TRIGGER IF EXISTS delete_followership_after_user_block");
    }
};
