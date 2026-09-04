@extends('layouts.app')

@section('titulo', 'Página não encontrada')

@section('conteudo')
    <div style="text-align: center; padding: 60px 20px;">
        <h1 style="font-size: 72px; border: none; margin: 0; padding: 0;">404</h1>
        <p style="font-size: 18px; color: #5f6b7a; margin-bottom: 24px;">
            Ops! A página que você procura não existe.
        </p>
        <a href="{{ route('propostas.index') }}" class="btn">Voltar para as Propostas</a>
    </div>
@endsection