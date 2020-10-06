import React from 'react';
import { Link } from 'react-router-dom';

function CategorySelector() {
    return (
        <div className="category-selector">
            <div>
                <h1>Select a category to Practice</h1>
            </div>
            <div className="row">
                <div className="col-md-6">
                    <Link className="category-selector__category-wrapper">
                        <div className="category-selector__image-wrapper">
                            <img src="/site/images/prelims-and-mains.png" alt="Prelims and Mains" />
                        </div>
                        <div className="category-selector__category-title">
                            <h4>Preparation</h4>
                        </div>
                    </Link>
                </div>
                <div className="col-md-6">
                    <Link className="category-selector__category-wrapper">
                        <div className="category-selector__image-wrapper">
                            <img src="/site/images/current-affairs.png" alt="Current Affairs" />
                        </div>
                        <div className="category-selector__category-title">
                            <h4>Current Affairs</h4>
                        </div>
                    </Link>
                </div>
            </div>

            <div className="row">
                <div className="col-md-6">
                    <Link className="category-selector__category-wrapper">
                        <div className="category-selector__image-wrapper">
                            <img src="/site/images/publications.png" alt="Publication" />
                        </div>
                        <div className="category-selector__category-title">
                            <h4>Publications</h4>
                        </div>
                    </Link>
                </div>
                <div className="col-md-6">
                    <Link className="category-selector__category-wrapper">
                        <div className="category-selector__image-wrapper">
                            <img src="/site/images/mock-tests.png" alt="Mock Tests" />
                        </div>
                        <div className="category-selector__category-title">
                            <h4>Mock Tests</h4>
                        </div>
                    </Link>
                </div>
            </div>

        </div>
    );
}

export default CategorySelector;
