import Expo from 'expo';
import React from 'react';
import { StyleSheet, Text, View } from 'react-native';
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
const messaging = firebase.messaging()
.then(function () {
  console.log('Have Permission');
  return messaging.getToken();
})
.then(function() {
  console.log(token);
})
.catch (function () {
  console.log('Error Occured.');
})


class App extends React.Component {
constructor () {
super();
this.state = {
    speed: 10
};

}
componentDidMount () {
    const rootRef = fire.database().ref().child('react');
    const speedRef = rootRef.child('speed');
  //   console.log(speedRef);
    speedRef.on('value', snap => {
      this.setState({
      speed: snap.val()
    });
  });
}

  render() {
    return (
      <View style={styles.container}>
        <Text>{this.state.speed}</Text>
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
});

Expo.registerRootComponent(App);
