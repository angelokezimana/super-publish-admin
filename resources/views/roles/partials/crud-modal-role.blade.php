<div class="modal fade" id="crud-modal-role" tabindex="-1" role="dialog" aria-labelledby="crud-modal-role-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crud-modal-role-label">Cr&eacute;er un r&ocirc;le</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <input type="hidden" name="role_id" id="role_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="form-control-label">Nom du r&ocirc;le</label>
                        <input type="text" id="name" name="name" placeholder="Entrez le nom"
                            class="form-control form-control-sm">
                        <div class="alert alert-danger hidden"></div>
                    </div>
                    <div class="form-group">
                        <label for="permissions" class="form-control-label">Permissions</label>
                        <select name="permissions[]" id="permissions" data-placeholder="Choisir une permission..."
                            multiple class="standardSelect">
                            {{-- <option value="" label="default"></option> --}}
                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger hidden permissions-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Fermer</button>
                    <button type="button" id="id-form"
                        class="btn btn-primary btn-sm crud-modal-role-form">Cr&eacute;er</button>
                </div>
            </form>
        </div>
    </div>
</div>
