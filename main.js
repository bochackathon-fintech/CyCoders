import Expo from 'expo';
import React from 'react';
import { StyleSheet, Text, View, TouchableHighlight} from 'react-native';
import * as firebase from 'firebase';
import { Kaede } from 'react-native-textinput-effects';


// Firebase SDK Connection
export const config = {
  apiKey: "AIzaSyDu7lwUQeF0rXLTLEP5dzq6tIH8V2kOJgE",
  authDomain: "awsomepiggy-aacf0.firebaseapp.com",
  databaseURL: "https://awsomepiggy-aacf0.firebaseio.com",
  projectId: "awsomepiggy-aacf0",
  storageBucket: "awsomepiggy-aacf0.appspot.com",
  messagingSenderId: "875965742442"
};
var fire =  firebase.initializeApp(config);

// Define Clickable Button for Main Render Function
export default class Button extends React.Component{
  render () {
    return (
      <TouchableHighlight>
      <View style={styles.button}>
        <Text style={styles.buttonText}>Tap Me</Text>
      </View>
      </TouchableHighlight>
    )
  }
}
// Initial App Class Component
class App extends React.Component {
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
    //  <View style={styles.container}>
      //  <Text style = {styles.Header}>Place your Amount:</Text>
      //  <Text>{this.state.balance}</Text>
      //    <Button/>
      <View style={[styles.card1, { backgroundColor: '#F9F7F6' }]}>
      <Text style={styles.title}></Text>
      <Kaede
        label={'Euro'}
        defaultValue={'Place Amount: '}
        editable={false}
      />
      <Kaede
        style={styles.input}
        label={'Amount:'}
        labelStyle={{
          color: 'white',
          backgroundColor: '#fcb794',
        }}
        inputStyle={{
          color: 'white',
          backgroundColor: '#db8d67',
        }}
        keyboardType="numeric"
      />
    </View>
    //  </View>

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
  },
  Header: {
    fontSize: 30,
    fontWeight: "bold",
    color: "#33AAFF",
    alignItems: 'center',
    justifyContent: 'center',
    position: 'absolute',
    top: 18,
    borderColor: '#33AAFF',
    borderRadius: 30,
  }
});
Expo.registerRootComponent(App);
