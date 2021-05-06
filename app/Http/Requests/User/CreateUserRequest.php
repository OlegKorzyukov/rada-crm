<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return true;

        //$this->image_resize($this->file('uAvatar')->getLinkTarget(), 200, 200);

        return $this->user()->can('create', new User());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'uName' => 'required|string|max:60|min:4',
            'uLogin' => 'required|string|max:30|min:4|unique:users,uLogin',
            'uPassword' => 'required|string|max:30|min:10',
            'uGroup' => 'required|numeric|max:255',
            'uDepartment' => 'required|string|max:200',
            'uPosition' => 'nullable|string|max:400',
        ];
    }

    /*protected function image_resize($file_name, $width, $height, $crop = FALSE)
    {
        list($wid, $ht) = getimagesize($file_name);
        $r = $wid / $ht;
        if ($crop) {
            if ($wid > $ht) {
                $wid = ceil($wid - ($width * abs($r - $width / $height)));
            } else {
                $ht = ceil($ht - ($ht * abs($r - $w / $h)));
            }
            $new_width = $width;
            $new_height = $height;
        } else {
            if ($width / $height > $r) {
                $new_width = $height * $r;
                $new_height = $height;
            } else {
                $new_height = $width / $r;
                $new_width = $width;
            }
        }
        $source = imagecreatefromjpeg($file_name);
        $dst = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($dst, $source, 0, 0, 0, 0, $new_width, $new_height, $wid, $ht);
        return $dst;
    }*/
}
