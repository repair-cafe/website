<?php namespace Liip\RepairCafe\Updates;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Migration;

class BuilderViewCreateLiipRepaircafeSearchIndexView extends Migration
{
    public function up()
    {
        DB::statement('
        CREATE VIEW liip_repaircafe_event_index_view AS
            select e1.id as event_id, e1.title as "value", COALESCE(e1.end, e1.start) as event_date, e1.is_published, e1.cafe_id from liip_repaircafe_events e1
            UNION
            select e2.id as event_id, CONCAT_WS(" ", e2.description, e2.street, e2.city, e2.zip) as "value", COALESCE(e2.end, e2.start) as event_date, e2.is_published, e2.cafe_id from liip_repaircafe_events e2
            UNION
            select e3.id as event_id, CONCAT_WS(" ", c.title, c.description) as "value", COALESCE(e3.end, e3.start) as event_date, e3.is_published, e3.cafe_id from liip_repaircafe_cafes c inner join liip_repaircafe_events e3 on e3.cafe_id = c.id
        ');

        DB::statement('
        CREATE VIEW liip_repaircafe_search_index_view AS
            select event.event_id, event.value, event.event_date, cafe.slug cafe_slug, cat.slug category_slug
            from liip_repaircafe_event_index_view event
            inner join liip_repaircafe_cafes cafe on event.cafe_id = cafe.id
            left join liip_repaircafe_event_category ec on ec.event_id = event.event_id
            left join liip_repaircafe_categories cat on ec.category_id = cat.id
            WHERE cafe.is_published = 1 and cafe.deleted_at is null and event.is_published = 1 and event.value <> "";
        ');
    }

    public function down()
    {
        DB::statement("DROP VIEW liip_repaircafe_search_index_view");
        DB::statement("DROP VIEW liip_repaircafe_event_index_view");
    }
}
