<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeatureResource;
use App\Models\Feature;
use App\Models\UsedFeature;
use Illuminate\Http\Request;

class Feature2Controller extends Controller
{
    public ?Feature $feature = null;

    public function __construct(Feature $feature)
    {
        $this->feature = Feature::where('route_name', 'feature2.index')->where('active', true)->firstOrFail();
    }

    public function index()
    {
        return inertia('Feature2/Index', [
            'feature' => new FeatureResource($this->feature),
            // after the calculate is done, return the 'answer' to the session 
            'answer' => session('answer')
        ]);
    }

    public function calculate(Request $request)
    {
        $user = $request->user();
        if ($user->available_credits < $this->feature->required_credits) {
            return back();
        }
        $data = $request->validate([
            'number1' => ['required', 'numeric'],
            'number2' => ['required', 'numeric'],
        ]);

        $number1 = (float) $data['number1'];
        $number2 = (float) $data['number2'];

        // decrease the user available credits by the required credits for a feature
        $user->decreaseCredits($this->feature->required_credits);

        // define the used feature
        UsedFeature::create([
            'feature_id' => $this->feature->id,
            'user_id' => $user->id,
            // 'data' => json_encode($data),
            'data' => $data,
            'credits' => $this->feature->required_credits,
        ]);

        // calculate the answer
        $answer = $number1 - $number2;
        return to_route('feature2.index')->with('answer', $answer);
    }
}
