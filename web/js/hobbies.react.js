var HobbySection = React.createClass({
    getInitialState: function() {
        return {
            hobbies: []
        }
    },
    componentDidMount: function() {
        this.loadHobbiesFromServer();
        setInterval(this.loadHobbiesFromServer, 2000);
    },
    loadHobbiesFromServer: function() {
        $.ajax({
            url: this.props.url,
            success: function (data) {
                this.setState({hobbies: data.hobbies});
            }.bind(this)
        });
    },
    render: function() {
        return (
            <div>
            <div className="notes-container">
            <h2 className="notes-header">Hobbies</h2>
            <div><i className="fa fa-plus plus-btn"></i></div>
            </div>
            <HobbyList hobbies={this.state.hobbies} />
        </div>
        );
    }
});
var HobbyList = React.createClass({
    render: function() {
        var hobbyNodes = this.props.hobbies.map(function(hobby) {
            return (
                <HobbyBox age={hobby.age} key={hobby.id}>{hobby.hobby}</HobbyBox>
            );
        });
        return (
            <section id="cd-timeline">
            {hobbyNodes}
            </section>
        );
    }
});
var HobbyBox = React.createClass({
    render: function() {
        return (
            <div className="cd-timeline-block">
            <div className="cd-timeline-img">
            </div>
            <div className="cd-timeline-content">
        <p>{this.props.children}</p>
        <span className="cd-date">{this.props.age}</span>
        </div>
        </div>
        );
    }
});
window.HobbySection = HobbySection;
