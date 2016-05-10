<?php
namespace App\Jobs;

use App\ChaoSky;

use App\ChaoPro;
use Carbon\Carbon;
use Illuminate\Contracts\Bus\SelfHandling;
class NewsFormFields extends Job implements SelfHandling
{
    /**
     * The id (if any) of the Post row
     *
     * @var integer
     */
    protected $tipid;
    /**
     * List of fields and default value for each field
     *
     * @var array
     */
    protected $fieldList = [
        'tiptitle' => '',
        'tipimg1' => '',
        'tipcontent' => '',
        'tipvideo' => '',
        'readnum'=>0,
        'commentflag'=> '0',
        'draftflag' => '0',
        'publish_date' => '',
        'publish_time' => '',
        'proid'=>'',
        'pro'=>''
    ];
    /**
     * Create a new command instance.
     *
     * @param integer $id
     */
    public function __construct($tipid = null)
    {
        $this->tipid = $tipid;
    }
    /**
     * Execute the command.
     *
     * @return array of fieldnames => values
     */
    public function handle()
    {
        $fields = $this->fieldList;
        if ($this->tipid) {
            $fields = $this->fieldsFromModel($this->tipid, $fields);
        } else {
            $when = Carbon::now();
            $fields['publish_date'] = $when->format('Y-m-d');
            $fields['publish_time'] = $when->format('H:i:s');
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }
        return array_merge(
            $fields,
            ['pros' => ChaoPro::all()]
        );
    }
    /**
     * Return the field values from the model
     *
     * @param integer $id
     * @param array $fields
     * @return array
     */
    protected function fieldsFromModel($tipid, array $fields)
    {
        $post = ChaoSky::findOrFail($tipid);
        $fieldNames = array_keys(array_except($fields, ['pro']));
        $fields = ['tipid' => $tipid];
        foreach ($fieldNames as $field) {
            $fields[$field] = $post->{$field};
        }
        $fields['pro'] = $post->chaoPro();
        return $fields;
    }
}