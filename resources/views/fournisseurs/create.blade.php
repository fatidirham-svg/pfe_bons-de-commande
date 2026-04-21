@extends('layouts.app')

@section('content')

<style>
    .custom-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-top: 5px solid #E30613;
    }

    .custom-header {
        background: white;
        border-bottom: none;
    }

    .icon-red {
        color: #E30613;
        font-size: 20px;
    }

    .input-icon {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background: #fff;
    }

    .input-icon i {
        color: #888;
        margin-right: 8px;
    }

    .input-icon input {
        border: none;
        outline: none;
        width: 100%;
    }

    .custom-btn {
        background: #E30613;
        color: white;
        padding: 12px;
        border-radius: 8px;
        font-weight: bold;
        border: none;
    }

    .custom-btn:hover {
        background: #c00510;
    }

    .secure-text {
        text-align: center;
        font-size: 12px;
        color: #888;
    }

    .secure-text i {
        color: orange;
        margin-right: 5px;
    }
</style>

<div class="container mt-5" style="max-width:700px">

    <div class="card custom-card">

        <!-- HEADER -->
        <div class="card-header custom-header">
            <div class="d-flex align-items-center gap-3">
                <i class="fa-solid fa-user-plus icon-red"></i>
                <div>
                    <h4 class="fw-bold mb-0">Ajouter un Fournisseur</h4>
                    <small class="text-muted">Enregistrez un nouveau partenaire</small>
                </div>
            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('fournisseurs.store') }}" method="POST">
                @csrf

                <!-- GRID STRUCTURE -->
                <div class="row g-3">

                    <!-- NOM -->
                    <div class="col-md-6">
                        <label class="form-label">Nom *</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-building"></i>
                            <input type="text" name="nom" placeholder="SARL Distribution" required>
                        </div>
                    </div>

                    <!-- EMAIL -->
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-envelope"></i>
                            <input type="email" name="email" placeholder="contact@mail.com">
                        </div>
                    </div>

                    <!-- TELEPHONE -->
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-phone"></i>
                            <input type="text" name="telephone" placeholder="+212...">
                        </div>
                    </div>

                    <!-- ADRESSE -->
                    <div class="col-md-6">
                        <label class="form-label">Adresse</label>
                        <div class="input-icon">
                            <i class="fa-solid fa-location-dot"></i>
                            <input type="text" name="adresse" placeholder="Casablanca">
                        </div>
                    </div>

                </div>

                <!-- BUTTON -->
                <div class="mt-4">
                    <button class="btn custom-btn w-100">
                        <i class="fa-solid fa-floppy-disk me-2"></i>
                        Enregistrer le Fournisseur
                    </button>
                </div>

            </form>

            <!-- FOOTER -->
            <p class="secure-text mt-3">
                <i class="fa-solid fa-shield-halved"></i>
                Données sécurisées
            </p>

        </div>
    </div>

</div>

@endsection