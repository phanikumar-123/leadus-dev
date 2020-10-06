import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Switch, Route } from 'react-router-dom';
import SideNav from './components/SideNav';
import QuestionComponent from './components/QuestionComponent';
import QuestionsRail from './components/QuestionsRail';
import CategorySelector from './components/CategorySelector';

class RootComponent extends Component {

    constructor(props) {
        super(props);
        var questions = require('../data/questions.json');

        this.state = {
            questions: questions.questions
        }
    }

    render() {
        return (
            <Router>
                <div className='wrapper'>
                    <SideNav />
                    <Switch>
                        <Route path="/home" exact={true}>
                            <HomeView />
                        </Route>
                        <Route path="/home/prelims">
                            <PrelimsView questions={this.state.questions} />
                        </Route>
                    </Switch>
                </div>
            </Router>
        );
    }
}

const HomeView = () => (
    <CategorySelector />
)

const PrelimsView = ({ questions }) => (
    <>
        <QuestionComponent />
        <QuestionsRail questions={questions} />
    </>
)

export default RootComponent;

if (document.getElementById('app')) {
    ReactDOM.render(<RootComponent />, document.getElementById('app'));
}
