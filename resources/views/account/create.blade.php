@extends('layouts.app')

@section('content')
    <div class="form-elements-wrapper">
        <div class="card-style mb-30">
            <form action="{{ route('account.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-style-1 @error('name') is-invalid @enderror">
                            <label>Nom</label>
                            <input name="name" type="text" />
                        </div>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <div class="input-style-1 @error('email') is-invalid @enderror">
                            <label>Email</label>
                            <input type="email" name="email" />
                        </div>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="select-style-1">
                    <label>Selectionner son role</label>
                    <div class="select-position">
                        <select name="role" class="@error('role') is-invalid @enderror">
                            <option selected disabled>Selectionner son rôle</option>
                            <option value="ope">Opérateur</option>
                            <option value="administration">Coordonnateur</option>
                            <option value="admin">IT</option>
                            <option value="support">Support</option>
                            <option value="administration">Administration</option>
                            <option value="account">Comptable</option>
                            <option value="user">User</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">
                                {{ $errors->first('role') }}
                            </div>
                        @enderror
                    </div>
                </div>
                <!-- end select -->
                <div class="col-lg-4">
                    <button type="submit" class="main-btn btn-sm primary-btn btn-hover mb-2">
                        Ajouter
                    </button>
                </div>
            </form>

        </div>
    </div>

@stop
