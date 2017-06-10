import Expo from 'expo';
import React from 'react';
import { StyleSheet, Text, View, TouchableHighlight} from 'react-native';
import * as firebase from 'firebase';
import { Kaede } from 'react-native-textinput-effects';


// Firebase SDK Connection
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

// Initial App Class Component
class Dashboard extends React.Component {
constructor () {
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
      <View style = {styles.container} >
  <Text style = {styles.text}>Balance: {this.state.balance} Deposit: {this.state.value}</Text>

      </View>
    )
  };
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
       justifyContent: 'center',
       alignItems: 'center',
       backgroundColor: '#43A047',
       flexDirection: 'column',
  },
  text: {
    backgroundColor: '#43A047',
    color: '#37474F',
  }
});
Expo.registerRootComponent(Dashboard);
