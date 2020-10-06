import React, { Component } from 'react';

class QuestionsRail extends Component {

    render() {
        return (
            <div className="question-rail">
                <div className="question-rail__title">
                    <h4>Browse Questions</h4>
                </div>
                <div className="question-rail__container">
                    {this.props.questions.map((ques, i) =>
                        <a href="#" className="question-rail__question-box" key={i}>{ques.number}</a>
                    )}
                </div>
            </div>
        );
    }
}

export default QuestionsRail;
