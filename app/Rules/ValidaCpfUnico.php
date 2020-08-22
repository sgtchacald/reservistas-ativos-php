<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Http\Controllers\Utils\UtilsController;
use App\Usuarios;

class ValidaCpfUnico implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(){
        $this->usuarios = new Usuarios();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value){
        return Usuarios::verificaSeExisteCPF(UtilsController::apenasNumeros($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'CPF já existente no sistema';
    }
}
