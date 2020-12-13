<div class="modal fade" id="crud-modal-user" tabindex="-1" role="dialog" aria-labelledby="crud-modal-user-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crud-modal-user-label">Cr&eacute;er un utilisateur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="last_name" class="form-control-label">Nom</label>
                            <input type="text" id="last_name" name="last_name"
                                placeholder="Entrez le nom" class="form-control form-control-sm">
                            <div class="alert alert-danger hidden"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="first_name" class="form-control-label">Pr&eacute;nom</label>
                            <input type="text" id="first_name" name="first_name"
                                placeholder="Entrez le prénom" class="form-control form-control-sm">
                            <div class="alert alert-danger hidden"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="email" class="form-control-label">E-mail</label>
                            <input type="email" id="email" name="email"
                                placeholder="Entrez l'e-mail" class="form-control form-control-sm">
                            <div class="alert alert-danger hidden"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="username" class="form-control-label">Pseudo</label>
                            <input type="text" id="username" name="username"
                                placeholder="Entrez le pseudo" class="form-control form-control-sm">
                            <div class="alert alert-danger hidden"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="role_id" class="form-control-label">R&ocirc;le</label>
                            <select name="role_id" id="role_id" class="form-control form-control-sm">
                                <option value="">Choisissez le r&ocirc;le</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="alert alert-danger hidden"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password" class="form-control-label">Mot de passe</label>
                            <input type="password" id="password" name="password"
                                placeholder="Entrez le mot de passe" class="form-control form-control-sm">
                            <div class="alert alert-danger hidden"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="form-control-label">Retapez le mot de passe</label>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Retapez le mot de passe" class="form-control form-control-sm">
                            <div class="alert alert-danger hidden"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fermer</button>
                    <button type="button" id="id-form" class="btn btn-primary btn-sm crud-modal-user-form">Cr&eacute;er</button>
                </div>
            </form>
        </div>
    </div>
</div>
