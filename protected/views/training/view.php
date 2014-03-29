<div ng-controller="trainingController">
    <div class="question">
        {{model.question.word}}
    </div>

    <div ng-repeat="item in model.answers" ng-click="selectAnswer()" ng-class="verification" class="translation">
        {{item}}
    </div>

    <button ng-controller="nextButtonController" ng-click="next()">{{textButton}}</button>
</div>