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

});

module.factory('selectAnswerFactory', function (model) {
    return function() {
        if(model.isSelected) return;
        if(this.item == model.question.translation) {
            this.verification = 'correct-answer';
        } else {
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

module.factory('nextFactory', function (model, dataFactory) {
    return function () {
        angular.forEach($('.translation'), function(element, key) {
            delete angular.element(element).scope().verification;
        });
        model.isSelected = false;
        if(dataFactory.step >= dataFactory.numberOfSteps - 1) {
            this.textButton = 'finish';
        } else {
            dataFactory.step++;
            model.question = dataFactory.getQuestion();
            model.answers = dataFactory.getAnswers();
        }
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