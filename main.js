import Expo from 'expo';
import React from 'react';
import { StyleSheet, Text, View, TouchableHighlight} from 'react-native';
import * as firebase from 'firebase';


const config = {
  apiKey: "AIzaSyDu7lwUQeF0rXLTLEP5dzq6tIH8V2kOJgE",
  authDomain: "awsomepiggy-aacf0.firebaseapp.com",
  databaseURL: "https://awsomepiggy-aacf0.firebaseio.com",
  projectId: "awsomepiggy-aacf0",
  storageBucket: "awsomepiggy-aacf0.appspot.com",
  messagingSenderId: "875965742442"
};
var fire =  firebase.initializeApp(config);

// Define Clickable Button for Main Render Function
class Button extends React.Component{
  render () {
    return (
      <TouchableHighlight onPress = { () => { console.log(this.props.value)}} >
      <View style={styles.button}>
        <Text style={styles.buttonText}>Tap Me</Text>
      </View>
      </TouchableHighlight>
    )
  }
}

// Initial App Class Component
class App extends React.Component {
constructor (props) {
super();
this.state = {
    balance: "",
    value: 1000
  };
}
// This will be triggered once Render is Finished and will Update Data in Firebase.
componentDidMount () {
    const rootRef = fire.database().ref().child('react');
    const balanceRef = rootRef.child('balance');
  //   console.log(speedRef);
    balanceRef.on('value', snap => {
      this.setState({
      balance: snap.val()
    });
  });

// Push data to the Database with Push Key
  const valueRef = fire.database().ref().child('value').push().key;
  var updates = {};
  updates['value'] = this.state.value;
  return fire.database().ref().update(updates);
}
// The Initial Main Render Function
  render() {
    return (
      <View style={styles.container}>
        <Text>{this.state.balance}</Text>
          <Button/>
      </View>
    );
  }
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    backgroundColor: '#fff',
    alignItems: 'center',
    justifyContent: 'center',
  },
  button: {
    backgroundColor: "#33AAFF",
    borderWidth: 10,
    borderRadius: 20,
    borderColor: "#33AAFF",
    padding: 5
  },
  buttonText: {
      fontSize: 24,
      fontWeight: "bold",
      color: "#FFFFFF"
  }
});
Expo.registerRootComponent(App);
