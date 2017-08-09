<?php namespace Liip\RepairCafe\Updates;

use Illuminate\Support\Facades\DB;
use October\Rain\Database\Updates\Migration;

class BuilderViewCreateLiipRepaircafeSearchIndexView extends Migration
{
    public function up()
    {
        DB::statement('
        CREATE VIEW liip_repaircafe_search_index_view AS
            select event.event_id, event.value, event.event_date, cafe.slug cafe_slug, cat.slug category_slug from (
                select e1.id as event_id, e1.title as "value", COALESCE(e1.end, e1.start) as event_date, e1.is_published, e1.cafe_id from liip_repaircafe_events e1
                UNION
                select e2.id as event_id, CONCAT_WS(" ", e2.description, e2.street, e2.city, e2.zip) as "value", COALESCE(e2.end, e2.start) as event_date, e2.is_published, e2.cafe_id from liip_repaircafe_events e2
                UNION
                select e3.id as event_id, CONCAT_WS(" ", c.title, c.description) as "value", COALESCE(e3.end, e3.start) as event_date, e3.is_published, e3.cafe_id from liip_repaircafe_cafes c inner join liip_repaircafe_events e3 on e3.cafe_id = c.id
                UNION
                select e4.id as event_id, t1.value as "value", COALESCE(e4.end, e4.start) as event_date, e4.is_published, e4.cafe_id from rainlab_translate_indexes t1 inner join liip_repaircafe_events e4 on e4.id = t1.model_id and t1.model_type = "Liip\\\\RepairCafe\\\\Models\\\\Event"
                UNION
                select e5.id as event_id, t2.value as "value", COALESCE(e5.end, e5.start) as event_date, e5.is_published, e5.cafe_id from rainlab_translate_indexes t2 inner join liip_repaircafe_cafes c2 on c2.id = t2.model_id and t2.model_type = "Liip\\\\RepairCafe\\\\Models\\\\Cafe" inner join liip_repaircafe_events e5 on e5.cafe_id = c2.id 
            ) event
            inner join liip_repaircafe_cafes cafe on event.cafe_id = cafe.id
            left join liip_repaircafe_event_category ec on ec.event_id = event.event_id
            left join liip_repaircafe_categories cat on ec.category_id = cat.id
            WHERE cafe.is_published = 1 and cafe.deleted_at is null and event.is_published = 1 and event.value <> "";
        ');
    }

    public function down()
    {
        DB::statement("DROP VIEW liip_repaircafe_search_index_view");
    }
}