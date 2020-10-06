import { thru } from 'lodash';
import React, { Component } from 'react';
import { Link, NavLink } from 'react-router-dom';

class SideNav extends Component {
    constructor(props) {
        super(props);

        this.state = {
            prepDropdownOpen: false
        }
        this.handleNavClick = this.handleNavClick.bind(this);
        this.toggleNavClose = this.toggleNavClose.bind(this);
    }

    handleNavClick(e) {
        e.preventDefault();
        this.setState({
            prepDropdownOpen: !this.state.prepDropdownOpen
        });
    }

    toggleNavClose() {
        this.setState({
            prepDropdownOpen: false
        });
    }

    render() {
        return (
            <nav className='sidenav'>
                <div className="sidenav__profile-image">
                    <Link to="/home/profile" onClick={this.toggleNavClose}>
                        <div className="profile-ring">
                            <img src="/site/images/1650.jpg" alt="Profile Image" />
                        </div>

                        <div className="profile-details">
                            <h4>Rohit Wanchoo</h4>
                            <p>ron.bhat0@gmail.com</p>
                        </div>
                    </Link>
                </div>

                <div className="sidenav__navigation">
                    <div className={`navitem dropdown  ${this.state.prepDropdownOpen ? 'open' : ''}`}>
                        <div className={`navlink ${this.state.prepDropdownOpen ? 'active' : ''}`} onClick={this.handleNavClick}><i className="fi flaticon-reading-book"></i>Preparation</div>
                        <div className="nav-dropdown-menu">
                            <NavLink activeClassName="active" to="/home/prelims" className="navlink"><i className="fi flaticon-book"></i>Prelims</NavLink>
                            <NavLink to="/home/mains" className="navlink"><i className="fi flaticon-creativity"></i>Mains</NavLink>
                        </div>
                    </div>
                    <div className="navitem" onClick={this.toggleNavClose}>
                        <NavLink activeClassName="active" to="/home/current-affairs" className="navlink"><i className="fi flaticon-paper"></i>Current Affairs</NavLink>
                    </div>
                    <div className="navitem" onClick={this.toggleNavClose}>
                        <NavLink activeClassName="active" to="/home/publications" className="navlink"><i className="fi flaticon-books-stack-of-three"></i>Publications</NavLink>
                    </div>
                    <div className="navitem" onClick={this.toggleNavClose}>
                        <NavLink activeClassName="active" to="/home/mocks" className="navlink"><i className="fi flaticon-checklist"></i>Mock Tests</NavLink>
                    </div>
                </div>
            </nav>
        );
    }
}

export default SideNav;
