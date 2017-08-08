<?php namespace Liip\RepairCafe\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Trait that can be imported into modals who have modals and need to be translated.
 *
 * This is a workaround for an open OctoberCMS bug. See: https://github.com/rainlab/translate-plugin/issues/209
 *
 * Trait TranslatableModal
 * @package AuthorName\ExamplePlugin
 */
trait TranslatableModal
{
    /**
     * Method that saves the translation data of modal.
     * TODO: Try to integrate this in translate plugin.
     *
     * @uses DB
     */
    public function afterSave()
    {
        if (post("RLTranslate")) {
            foreach (post("RLTranslate") as $key => $value) {

                $data = json_encode($value);

                $obj = Db::table("rainlab_translate_attributes")
                    ->where("locale", $key)
                    ->where("model_id", $this->id)
                    ->where("model_type", get_class($this->model));

                // If the translate object exist in database update it
                if ($obj->count() > 0) {
                    $obj->update(["attribute_data" => $data]);
                }

            }
        }
    }
}
