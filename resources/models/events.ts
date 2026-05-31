export type Gallery = {
    name: string
    url: string
}

export type JsonEvent = {
    start_date: string
    end_date: string
    identifier: string
    name: string
    featured?: boolean
    description: string
    short_description: string
    address: string
    lat: number
    lng: number
    color: string
    registration_location: 'Local' | 'Both' | 'Remote'
    origin_url: string
    registration_required: boolean
    galleries?: Gallery[]
}

export type JsonEventDetails = JsonEvent & {
    attendees_count: number
}

export type Event = {
    start_date: Date
    end_date: Date
    identifier: string
    name: string
    featured?: boolean
    description: string
    short_description: string
    address: string
    lat: number
    lng: number
    color: string
    registration_location: 'Local' | 'Both' | 'Remote'
    origin_url: string
    registration_required: boolean
    galleries?: Gallery[]
}

export type EventDetails = Event & {
    attendees_count: number
}
