app.controller('ManageCountries_StatesController', function ($scope, $http, $location, ShareDataService) {
    ////
    // Paging Task
    ////
    $scope.countries = [];

    ////
    // Paging Task
    ////
    var cntries = $http({
        method: 'get',
        data: {},
        url: '/Home/GetCountries_ByAdmin'
    });
    cntries.then(function (cs) {
        $scope.countries = cs.data;

        //REGION Paging CountryList
        $scope.itemsPerPage = 10;
        $scope.currentPage = 0;

        $scope.prevPage = function () {
            if ($scope.currentPage > 0) {
                $scope.currentPage--;
            }
        }
        $scope.prevPageDisabled = function () {
            return $scope.currentPage === 0 ? "disabled" : "";
        }
        $scope.pageCount = function () {
            $scope.totalPagesCountries = Math.ceil($scope.countries.length / $scope.itemsPerPage);
            return Math.ceil($scope.countries.length / $scope.itemsPerPage) - 1;
        }
        $scope.nextPage = function () {
            if ($scope.currentPage < $scope.pageCount()) {
                $scope.currentPage++;
            }
        }
        $scope.nextPageDisabled = function () {
            return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
        }
        //ENDREGION
    });

    $scope.countryAddText = "Add New";
    $scope.stateAddText = "Add New";
    $scope.ReturnedMessage = "";

    $scope.bindState = function (countryId, countryName) {
        $scope.countryId = countryId;
        $scope.editcountryName = countryName;
        getStates();
    }
    $scope.states = [];
    function getStates() {
        var sts = $http({
            method: 'get',
            data: {},
            url: '/Home/GetStates/' + $scope.countryId
        });
        sts.then(function (cs) {
            $scope.states = cs.data;

//REGION Paging StateList
            $scope.itemsPerPage = 10;
            $scope.currentPage = 0;

            $scope.prevPage = function () {
                if ($scope.currentPage > 0) {
                    $scope.currentPage--;
                }
            }
            $scope.prevPageDisabled = function () {
                return $scope.currentPage === 0 ? "disabled" : "";
            }
            $scope.pageCount = function () {
                $scope.totalPagesStates = Math.ceil($scope.states.length / $scope.itemsPerPage);
                return Math.ceil($scope.states.length / $scope.itemsPerPage) - 1;
            }
            $scope.nextPage = function () {
                if ($scope.currentPage < $scope.pageCount()) {
                    $scope.currentPage++;
                }
            }
            $scope.nextPageDisabled = function () {
                return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
            }
//ENDREGION

        });
    }

    $scope.addNewCountry = function () {
        var model = { Id: $scope.countryId, CountryName: $scope.CountryName}
        var addCountry = $http({
            method: 'post',
            data: model,
            url: '/Admin/CountryInsertUpdate/'
        });
        addCountry.then(function (cs) {
            var jsonData = JSON.parse(cs.data);
            if (jsonData.IsLoggedIn == 1) {
                $scope.ReturnedMessage = jsonData.Message;
                var div = document.getElementById("sharedMessaegeDivSuccess");
                div.textContent = $scope.ReturnedMessage;
                $(div).show();
                $(div).fadeOut(8000);
                var cntries = $http({
                    method: 'get',
                    data: {},
                    url: '/Home/GetCountries_ByAdmin'
                });
                cntries.then(function (cs) {
                    $scope.countries = cs.data;
                });
                setTimeout(function () { window.location.reload(); }, 2000);
            }
            else if (jsonData.IsLoggedIn == -1)
            {
                // $location.path('/AdminLogin');
                location.href = '/Account/AdminLogin';
            }
        });
    }

    $scope.DeleteCountry = function (Id) {
        if (confirm('Are you sure to delete ?')) {
            var model = { Id: Id }
            var deleteCountry = $http({
                method: 'post',
                data: model,
                url: '/Admin/CountryDelete/'
            });
            deleteCountry.then(function (cs) {
                var jsonData = JSON.parse(cs.data);
                if (jsonData.IsLoggedIn == 1) {
                    $scope.ReturnedMessage = jsonData.Message;
                    var div = document.getElementById("sharedMessaegeDivSuccess");
                    div.textContent = $scope.ReturnedMessage;
                    $(div).show();
                    $(div).fadeOut(8000);
                    var cntries = $http({
                        method: 'get',
                        data: {},
                        url: '/Home/GetCountries'
                    });
                    cntries.then(function (cs) {
                        $scope.countries = cs.data;
                    });
                }
                else if (jsonData.IsLoggedIn == -1)
                {
                    // $location.path('/AdminLogin');
                    location.href = '/Account/AdminLogin';
                }
            });
        }
    }

    $scope.editCountry = function (id, name) {
        $scope.countryId = id;
        $scope.CountryName = name;
        $scope.countryAddText = "Update";
    }

    $scope.cancelCountryEdit = function () {
        $scope.countryId = 0;
        $scope.CountryName = "";
        $scope.countryAddText = "Add New";
    }


    // State Management

    $scope.addNewState = function () {
        if ($scope.countryId > 0) {
            var model = { Id: $scope.StateId, StateName: $scope.StateName, CountryID: $scope.countryId }
            var addState = $http({
                method: 'post',
                data: model,
                url: '/Admin/StateInsertUpdate/'
            });
            addState.then(function (cs) {
                var jsonData = JSON.parse(cs.data);
                if (jsonData.IsLoggedIn == 1) {
                    $scope.ReturnedMessage = jsonData.Message;
                    var div = document.getElementById("sharedMessaegeDivSuccess");
                    div.textContent = $scope.ReturnedMessage;
                    $(div).show();
                    $(div).fadeOut(8000);
                    var sts = $http({
                        method: 'get',
                        data: {},
                        url: '/Home/GetStates/' + $scope.countryId
                    });
                    sts.then(function (cs) {
                        $scope.states = cs.data;
                    });
                }
                else if (jsonData.IsLoggedIn == -1)
                {
                    //  $location.path('/AdminLogin');
                    location.href = '/Account/AdminLogin';
                }
            });
        }
        else {
            alert('Select a country first');
        }
    }

    $scope.DeleteState = function (Id) {
        if (confirm('Are you sure to delete?')) {
            if ($scope.countryId > 0) {
                var model = { Id: Id }
                var deleteState = $http({
                    method: 'post',
                    data: model,
                    url: '/Admin/StateDelete/'
                });
                deleteState.then(function (cs) {
                    var jsonData = JSON.parse(cs.data);
                    if (jsonData.IsLoggedIn == 1) {
                        $scope.ReturnedMessage = jsonData.Message;
                        var div = document.getElementById("sharedMessaegeDivSuccess");
                        div.textContent = $scope.ReturnedMessage;
                        $(div).show();
                        $(div).fadeOut(8000);
                        var sts = $http({
                            method: 'get',
                            data: {},
                            url: '/Home/GetStates/' + $scope.countryId
                        });
                        sts.then(function (cs) {
                            $scope.states = cs.data;
                        });
                    }
                    else if (jsonData.IsLoggedIn == -1)
                    {
                        // $location.path('/AdminLogin');
                        location.href = '/Account/AdminLogin';
                    }
                });
            }
        }
    }

    $scope.editState = function (id, name) {
        $scope.StateId = id;
        $scope.StateName = name;
        $scope.stateAddText = "Update";
    }

    $scope.cancelStateEdit = function () {
        $scope.StateId = 0;
        $scope.StateName = "";
        $scope.stateAddText = "Add New";
    }

});