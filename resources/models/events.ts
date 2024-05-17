export type JsonEvent = {
    start_date: string
    end_date: string
    identifier: string
    name: string
    featured?: boolean
    description: string
    short_description: string
}


export type Event = {
    start_date: Date
    end_date: Date
    identifier: string
    name: string
    featured?: boolean
    description: string
    short_description: string
}
