import React, { Component } from 'react';

class QuestionComponent extends Component {

    constructor(props) {
        super(props);

        this.state = {
            options: [
                {
                    name: 'A',
                    text: '1, 2 and 3',
                    value: 'a'
                },
                {
                    name: 'B',
                    text: '1 and 3',
                    value: 'b'
                },
                {
                    name: 'C',
                    text: 'Only 1',
                    value: 'c'
                },
                {
                    name: 'D',
                    text: 'None of the above',
                    value: 'd'
                },
            ]
        }
    }

    render() {
        return (
            <div className="question-comp">
                <div className="question-comp__window-wrapper">
                    <div className="question-comp__title">
                        <h2>Question 1:</h2>
                    </div>
                    <div className="question-comp__question-wrapper">
                        <p>Consider the following statements about the Cen­tral Highlands:</p>
                        <ol>
                            <li>They are bordered to the west by the Aravalli range.</li>
                            <li>The Satpura range at an elevation varying between 400 900 m above the mean sea level. forms the northernmost boundary of the Deccan Plateau.</li>
                            <li>The Satpura range is a classic example of the relict mountains which are highly denuded and fonn discontinuous ranges.</li>
                        </ol>
                        {/* <img src="/site/images/map.jpeg" alt="Map" /> */}
                        <p>Which of the above statements is/are correct?</p>
                    </div>
                    <div className="question-comp__options-wrapper">
                        <div className="row">
                            {this.state.options.map((option, i) =>
                                <div className="question-comp__option col-md-6 d-flex" key={i}>
                                    <span>{option.name}: </span>
                                    <div className="option-pill" value={option.value}>
                                        <p>{option.text}</p>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
                <div className="question-comp__controls d-flex justify-content-between align-items-center">
                    <div className="question-nav">
                        <button type="button" className="btn btn-light"><i className="fa fa-angle-double-left" /> Previous</button>
                        <button type="button" className="btn btn-light">Next <i className="fa fa-angle-double-right" /></button>
                    </div>

                    <div className="review-ans-wrapper">
                        <button type="button" className="btn btn-success">Check Answer</button>
                    </div>
                </div>
            </div>
        );
    }
}

export default QuestionComponent;
