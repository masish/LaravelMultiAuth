<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'game_time' => 'date',
            'g_date' => 'required_with:g_time',
            'g_time' => 'required_with:g_date',
            'stadium_id' => 'required|integer',
            'home_club_id' => 'required|integer',
            'away_club_id' => 'required|integer',
            'first_scored_player_id' => 'nullable|integer',
        ];
    }

    public function validate()
    {
        if ($this->input('g_date') && $this->input('g_time') )
        {
            $gameDate = implode(' ', $this->only(['g_date', 'g_time']));
            $this->merge([
                'game_time' => $gameDate,
            ]);
        }

        //$this->flashOnly('g_date', 'g_time')

        return parent::validate();
    }

}
