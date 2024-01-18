from flask import Flask, request, jsonify
import spacy
import pandas as pd
import numpy as np
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from sklearn.preprocessing import LabelEncoder
from sklearn.svm import SVC
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Load Spacy model
nlp = spacy.load("en_core_web_sm")

# Load existing data
existing_data = pd.read_csv('./ipc_sections.csv')

# Function to extract entities
def extract_entities(text):
    doc = nlp(text)
    return ' '.join([ent.text.lower() for ent in doc.ents])

# Apply entity extraction to the existing data
existing_data['Entities'] = existing_data['Offense'].apply(extract_entities).dropna()

# Flatten the data
flattened_data = existing_data[['Section', 'Punishment', 'Entities']].explode('Entities')

# Label encode the sections
label_encoder = LabelEncoder()
flattened_data['Section_Label'] = label_encoder.fit_transform(flattened_data['Section'])

def extract_entities(text):
    doc = nlp(text)
    return ' '.join([ent.text.lower() for ent in doc.ents])

existing_data['Entities'] = existing_data['Offense'].apply(extract_entities)

existing_data.count()

existing_data['Entities'].sample(10)



# Train the classifier
flattened_data['Entities'] = flattened_data['Entities'].fillna('')
tfidf_vectorizer = TfidfVectorizer(lowercase=True)
tfidf_matrix = tfidf_vectorizer.fit_transform(flattened_data['Entities'])

classifier = SVC(kernel='linear')
classifier.fit(tfidf_matrix, flattened_data['Section_Label'])

def predict_section_and_punishment(user_input):
    user_entities = extract_entities(user_input)

    if isinstance(user_entities, str):
        user_entities = [user_entities]

    user_tfidf = tfidf_vectorizer.transform(user_entities)
    predicted_label = classifier.predict(user_tfidf)

    predicted_section = label_encoder.inverse_transform(predicted_label)
    punishment = existing_data[existing_data['Section'] == predicted_section[0]]['Punishment'].iloc[0]

    return predicted_section[0], punishment

@app.route('/predict_section_and_punishment', methods=['POST'])
def predict_endpoint():
    try:
        user_input = request.json['userInput']
        section, punishment = predict_section_and_punishment(user_input)
        return jsonify({'result1': section, 'result2': punishment})
    except Exception as e:
        return jsonify({'error': str(e)})

if __name__ == '__main__':
    app.run(debug=True)







        
# from flask import Flask, request, jsonify
# import spacy
# import pandas as pd
# import numpy as np
# from sklearn.feature_extraction.text import TfidfVectorizer
# from sklearn.metrics.pairwise import cosine_similarity
# from sklearn.preprocessing import LabelEncoder
# from sklearn.svm import SVC
# from flask_cors import CORS

# app = Flask(__name__)
# CORS(app)

# # Load Spacy model
# nlp = spacy.load("en_core_web_sm")

# # Load existing data
# existing_data = pd.read_csv('ipc_sections.csv')

# # Function to extract entities
# def extract_entities(text):
#     doc = nlp(text)
#     return ' '.join([ent.text.lower() for ent in doc.ents])

# # Apply entity extraction to the existing data
# existing_data['Entities'] = existing_data['Offense'].apply(extract_entities)

# # Flatten the data
# flattened_data = existing_data[['Section', 'Punishment', 'Entities']].explode('Entities')

# # Label encode the sections
# label_encoder = LabelEncoder()
# flattened_data['Section_Label'] = label_encoder.fit_transform(flattened_data['Section'])

# # Train the classifier
# tfidf_vectorizer = TfidfVectorizer(lowercase=True)
# tfidf_matrix = tfidf_vectorizer.fit_transform(flattened_data['Entities'])

# classifier = SVC(kernel='linear')
# classifier.fit(tfidf_matrix, flattened_data['Section_Label'])

# def predict_section_and_punishment(user_input):
#     user_entities = extract_entities(user_input)

#     if isinstance(user_entities, str):
#         user_entities = [user_entities]

#     user_tfidf = tfidf_vectorizer.transform(user_entities)
#     predicted_label = classifier.predict(user_tfidf)

#     predicted_section = label_encoder.inverse_transform(predicted_label)
#     punishment = existing_data[existing_data['Section'] == predicted_section[0]]['Punishment'].iloc[0]

#     return predicted_section[0], punishment

# @app.route('/predict_section_and_punishment', methods=['POST'])
# def predict_endpoint():
#     try:
#         user_input = request.json['userInput']
#         section, punishment = predict_section_and_punishment(user_input)
#         return jsonify({'result1': section, 'result2': punishment})
#     except Exception as e:
#         return jsonify({'error': str(e)})

# if __name__ == '__main__':
#     app.run(debug=True)







        