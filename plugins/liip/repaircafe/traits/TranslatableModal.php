<?php namespace Liip\RepairCafe\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Trait that can be imported into modals who have modals and need to be translated.
 *
 * This is a workaround for an open OctoberCMS bug.
 * See: https://github.com/rainlab/translate-plugin/issues/209
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
            foreach (post("RLTranslate") as $locale => $value) {
                $this->updateTranslateAttributes($value, $locale);

                $optionedAttributes = $this->getTranslatableAttributesWithOptions();
                if (!count($optionedAttributes)) {
                    continue;
                }

                foreach ($value as $field => $field_value) {
                    $translatableOptionedAttribute = array_get($optionedAttributes, $field);
                    if (!array_get($translatableOptionedAttribute, 'index', false)) {
                        continue;
                    }

                    $this->updateTranslateIndexes($field, $field_value, $locale);
                }
            }
        }
    }

    protected function updateTranslateAttributes($value, $locale)
    {
        $data = json_encode($value);

        // search in rainlab_translate_attributes for existing value
        $obj = Db::table("rainlab_translate_attributes")
            ->where("locale", $locale)
            ->where("model_id", $this->id)
            ->where("model_type", get_class($this->model));

        // If the translate object exist in database update it otherwise create it
        if ($obj->count() > 0) {
            $obj->update(["attribute_data" => $data]);
        } else {
            Db::table('rainlab_translate_attributes')->insert([
                'locale' => $locale,
                'model_id' => $this->id,
                'model_type' => get_class($this->model),
                'attribute_data' => $data
            ]);
        }
    }

    protected function updateTranslateIndexes($field, $value, $locale)
    {
        // search in rainlab_translate_indexes for existing value
        $obj = Db::table('rainlab_translate_indexes')
            ->where('locale', $locale)
            ->where('model_id', $this->id)
            ->where('model_type', get_class($this->model))
            ->where('item', $field);

        $recordExists = $obj->count() > 0;

        if (!strlen($value)) {
            if ($recordExists) {
                $obj->delete();
            }
            return;
        }

        if ($recordExists) {
            $obj->update(['value' => $value]);
        } else {
            Db::table('rainlab_translate_indexes')->insert([
                'locale' => $locale,
                'model_id' => $this->id,
                'model_type' => get_class($this->model),
                'item' => $field,
                'value' => $value
            ]);
        }
    }
}
