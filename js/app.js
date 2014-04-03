var module = angular.module('trainingWordTranslation',[]);
module.factory('dataFactory', function() {
    return new function() {
        this.step = 0;
        this.numberOfSteps = data.length;
        this.getQuestion = function() {
            return data[this.step][0];
        };
        this.getAnswers = function() {
            return data[this.step][1];
        };
    };
});

module.value('model', {
    resultTraining: []
});

module.factory('selectAnswerFactory', function (model) {
    return function() {
        if(model.isSelected) return;
        if(this.item == model.question.translation) {
            this.verification = 'correct-answer';
            model.resultTraining.push({word: model.question.word, id: model.question.id, result: true});
        } else {
            model.resultTraining.push({word: model.question.word, id: model.question.id, result: false});
            this.verification = 'uncorrect-answer'
            angular.forEach($('.translation'), function(element, key) {
                var scope = angular.element(element).scope();
                if (scope.item == model.question.translation)
                    scope.verification = 'correct-answer';
            });
        }
        model.isSelected = true;
    }
});

module.factory('nextFactory', function ($http, model, dataFactory) {
    return function () {
        angular.forEach($('.translation'), function(element, key) {
            delete angular.element(element).scope().verification;
        });
        model.isSelected = false;
        if(this.textButton == 'finish') {
            model.templateUrl = "/js/template/result.html";
            $http.put('http://trainingwords.loc/index.php/training/ProcessingOfResultsOfTraining', model.resultTraining);
            return;
        }
        dataFactory.step++;
        if(dataFactory.step >= dataFactory.numberOfSteps - 1) {
            this.textButton = 'finish';
        }
        model.question = dataFactory.getQuestion();
        model.answers = dataFactory.getAnswers();
    }
});

module.controller('trainingController', function ($scope, model, selectAnswerFactory, dataFactory) {
    $scope.model = model;
    model.question = dataFactory.getQuestion();
    model.answers = dataFactory.getAnswers();
    model.isSelected = false;
    $scope.selectAnswer = selectAnswerFactory;
});

module.controller('nextButtonController', function ($scope, nextFactory) {
    $scope.textButton = 'next';
    $scope.next = nextFactory;
});

module.controller('trainingContainerController', function($scope, model) {
    $scope.model = model;
    model.templateUrl = "/js/template/training.html";
});

module.controller('resultController', function($scope, model) {
    $scope.model = model;
    $scope.resultClass = function(index) {
        if (model.resultTraining[index].result)
            return 'correct-answer';
        else
            return 'uncorrect-answer';
    };
    $scope.resultText = function(index) {
        if (model.resultTraining[index].result)
            return 'ok';
        else
            return 'error';
    };
});