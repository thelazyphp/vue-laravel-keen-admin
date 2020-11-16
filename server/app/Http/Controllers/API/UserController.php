<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\QueryResourceCollection;
use App\Filters\UsersFilter;
use App\Http\Resources\Users;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use Illuminate\Validation\Rule;
use App\Models\Company;
use App\Models\UserImage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\QueryResourceCollection  $request
     * @return \Illuminate\Http\Response
     */
    public function index(QueryResourceCollection $request)
    {
        $perPage = $request->query('per_page');

        if ($perPage > 200) {
            $perPage = 200;
        }

        $filter = new UsersFilter($request);

        return new Users(
            auth()->user()
            ->company
            ->users()
            ->filter($filter)
            ->paginate($perPage)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->authorize(
        //     'create', User::class
        // );

        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        $validated = $validator->validate();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->comapny()->associate($request->user()->company);

        $user->save();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // $this->authorize(
        //     'view', $user
        // );

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $this->authorize(
        //     'update', $user
        // );

        $rules = [
            'name' => ['filled', 'string', 'max:50'],
            'email' => ['filled', 'email', 'max:50', Rule::unique('users')->ignore($user)],
            'password' => ['string', 'min:8'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return new UserResource(
            tap($user)->update(
                tap($validator->validate(), function (&$validated) {
                    if (isset($validated['password'])) {
                        $validated['password'] = Hash::make($validated['password']);
                    }
                })
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // $this->authorize(
        //     'delete', $user
        // );

        $user->delete();

        return response('', 204);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        $validated = $validator->validate();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->company->associate(
            Company::create([
                'owner_id' => $user->id,
            ])
        );

        $user->save();

        return new UserResource($user);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateCompany(Request $request, User $user)
    {
        // $this->authorize(
        //     'updateCompany', $user
        // );

        $rules = [
            'name' => ['nullable', 'string', 'max:50'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        $user->company()->update($validator->validate());

        return new UserResource($user);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, User $user)
    {
        // $this->authorize(
        //     'updateImage', $user
        // );

        $rules = [
            'file' => ['required', 'file', 'image', 'max:51200'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        $validator->validate();

        if (! $request->file('file')->isValid()) {
            return response()->json([
                'message' => trans('api.errors.upload'),
            ], 500);
        }

        $url = config('app.url').'/storage/'.$request->photo->store(
            'images', 'public'
        );

        if ($user->image) {
            $user->image()->update([
                'url' => $url,
            ]);
        } else {
            $image = new UserImage([
                'url' => $url,
            ]);

            $user->image()->save($image);
        }

        return new UserResource($user);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateAccount(Request $request, User $user)
    {
        // $this->authorize(
        //     'updateAccount', $user
        // );

        $rules = [
            'email' => ['filled', 'email', 'max:50', Rule::unique('users')->ignore($user)],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return new UserResource(
            tap($user)->update($validator->validate())
        );
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request, User $user)
    {
        // $this->authorize(
        //     'updateProfile', $user
        // );

        $rules = [
            'name' => ['filled', 'string', 'max:50'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return new UserResource(
            tap($user)->update($validator->validate())
        );
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $user)
    {
        // $this->authorize(
        //     'updatePassword', $user
        // );

        $rules = [
            'password' => ['required', 'password'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        $validator = Validator::make(
            $request->all(),
            $rules,
            trans('api.errors.validation')
        );

        return new UserResource(
            tap($user)->update(
                tap($validator->validate(), function (&$validated) {
                    $validated['password'] = Hash::make($validated['new_password']);
                })
            )
        );
    }
}
