<input type="hidden" id="userPermissions" value="{{ json_encode(auth()->user()->getPermissionsViaRoles()) }}">
