angular.module('app')

.factory('principal', ['$q', '$http', '$timeout',
  function($q, $http, $timeout) {
    var _identity = undefined,
      _authenticated = false;

    return {
      isIdentityResolved: function() {
        return angular.isDefined(_identity);
      },
      isAuthenticated: function() {
        return _authenticated;
      },
      isInRole: function(role) {
        if (!_authenticated || !_identity.roles) return false;

        return _identity.roles.indexOf(role) != -1;
      },
      isInAnyRole: function(roles) {
        if (!_authenticated || !_identity.roles) return false;

        for (var i = 0; i < roles.length; i++) {
          if (this.isInRole(roles[i])) return true;
        }

        return false;
      },
      authenticate: function(identity) {
        _identity = identity;
        _authenticated = identity != null;

        // for this demo, we'll store the identity in localStorage. For you, it could be a cookie, sessionStorage, whatever
        if (identity) localStorage.setItem("app.identity", angular.toJson(identity));
        else localStorage.removeItem("app.identity");
      },
      identity: function(force) {
        var deferred = $q.defer();

        if (force === true) _identity = undefined;

        // check and see if we have retrieved the identity data from the server. if we have, reuse it by immediately resolving
        if (angular.isDefined(_identity)) {
          deferred.resolve(_identity);

          return deferred.promise;
        }

        /*$http.get('/svc/account/identity', { ignoreErrors: true })
              .success(function(data) {
                 _identity = data;
                  _authenticated = true;
                 deferred.resolve(_identity);
              })
              .error(function () {
                   _identity = null;
                   _authenticated = false;
                   deferred.resolve(_identity);
               });*/

        var self = this;
        $timeout(function() {
            _identity = angular.fromJson(localStorage.getItem("app.identity"));
            self.authenticate(_identity);
            deferred.resolve(_identity);
        }, 500);

        return deferred.promise;
      }
    };
  }
])