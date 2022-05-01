@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Bem vindo(a)') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Este é o sistema de gestão operacional da Peça Rara Brechó.
                    
                    Em caso de dúvidas, por favor acione o ponto focal de suporte técnico.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
