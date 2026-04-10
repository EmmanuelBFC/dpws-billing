@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        @if (session()->has('message'))
            <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('message') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-lg-4">
            <a  type="button" class="main-btn btn-sm primary-btn btn-hover mb-2" href="{{route('account.create')}}"
                    ><i class="lni lni-plus me-2"></i> Ajouter un utilisateur
            </a>
        </div>
        <div class="card-style mb-30">
            <h6 class="mb-10"></h6>
            <div class="table-wrapper table-responsive">
                <table class="table striped-table">
                    <thead>
                    <tr>
                        <th> <h6>Nom</h6> </th>
                        <th> <h6>email</h6> </th>
                        <th><h6>Rôle</h6></th>
                        <th><h6>Statut</h6></th>
{{--                        <th><h6>Mode Paiement</h6></th>--}}
{{--                        <th><h6>Montant</h6></th>--}}
{{--                        <th><h6>statut</h6></th>--}}
                        <th><h6>Actions</h6></th>
                    </tr>
                    <!-- end table row-->
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>
                                <p>{{$user->name}}</p>
                            </td>
                            <td>
                                <h6 class="text-sm">{{$user->email}}</h6>
                            </td>
                            <td>
                                <h6 class="text-sm">{{$user->role}}</h6>
                            </td>
                            <td>
                                <p> <span class="status-btn success-btn">{{$user->status}}</span> </p>
                            </td>
                            <td>
                                <div class="action justify-content-end">
                                    <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="lni lni-more-alt"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end"
                                        aria-labelledby="moreAction1">
                                        <li class="dropdown-item">
                                            <a style="color:grey" class="link-primary"
                                               href="{{route('account.edit',$user->id)}}">
                                                Editer l'utilisateur
                                            </a>
                                        </li>
                                        <li class="dropdown-item">
                                            <a onclick="event.preventDefault(); document. getElementById('reset').submit();" style="color:grey" class="link-primary"
                                               href="">
                                                Rénitialiser le mot de passe
                                            </a>
                                            <form id="reset" action="{{ route('reset.password', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                            </form>
                                        </li>
                                        <li class="dropdown-item">
                                            <a style="color:grey" class="link-primary"
                                               href="javascript:void(0)">
                                                Désactiver le compte
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                       pas d'utilisateur
                    @endforelse

                    </tbody>
                </table>
                <!-- end table -->
            </div>
        </div>
        <!-- end card -->
    </div>
@stop
